<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('Inicio/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function login_checkAction()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     * @Route("/inicio", name="inicio")
     */
    public function inicioAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $totalEjecutado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoEjecutado();
        $totalDisponible = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoDisponible();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();
        $graficosExpedientesEstados = $em->getRepository('AppBundle:Expedientes')->graficoExpedientesEstados();
        $graficosPresupuestosSecciones = $em->getRepository('AppBundle:Presupuestosservicios')->graficoSeccionesPresupuestos();
        $totalActivos = $em->getRepository('AppBundle:Expedientes')->graficoTotalActivos();
        $totalPrioridad = $em->getRepository('AppBundle:Expedientes')->graficoTotalPrioridad();
        $totalMandamientoPago = $em->getRepository('AppBundle:Expedientes')->graficoTotalMandamientoPago();
        $actividadesHoy = $em->getRepository('AppBundle:Expedientes')->actividadesHoy();
        $partidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->partidasFondos();
        $partidasSinUsos = $em->getRepository('AppBundle:Presupuestosservicios')->partidasSinUsos();

        $fechaTraza = $em->getRepository('AppBundle:Traza')->getLastTraza();
        if($fechaTraza != 0)
        {
            $actual = new \DateTime('now');
            $yearActual = $actual->format('Y');
            $yearTraza =  $fechaTraza['fecha']->format('Y');
            if($yearTraza < $yearActual)
            {
                $em->getRepository('AppBundle:Expedientes')->desactivarExpedientes();
            }
        }

        return $this->render('Inicio/inicio.html.twig', array(
                'tipoMoneda' => $tipoMoneda,
                'totalInicial' => $totalInicial,
                'totalGastado' => $totalGastado,
                'totalEjecutado' => $totalEjecutado,
                'totalDisponible' => $totalDisponible,
                'cantidadPartidasFondos' => $cantidadPartidasFondos,
                'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
                'graficosExpedientesEstados' => $graficosExpedientesEstados,
                'graficosPresupuestosSecciones' => $graficosPresupuestosSecciones,
                'totalActivos' => $totalActivos,
                'totalPrioridad' => $totalPrioridad,
                'totalMandamientoPago' => $totalMandamientoPago,
                'actividadesHoy' => $actividadesHoy,
                'partidasFondos' => $partidasFondos,
                'partidasSinUsos' => $partidasSinUsos,
            )
        );

    }

    /**
     * @Route("/passwordForm", name="passwordForm")
     */
    public function passwordFormdAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        return $this->render('Inicio/cambiarPassword.html.twig' , array(
                'tipoMoneda' => $tipoMoneda,
                'totalInicial' => $totalInicial,
                'totalGastado' => $totalGastado,
                'cantidadPartidasFondos' => $cantidadPartidasFondos,
                'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
        ));
    }

    /**
     * @Route("/changePassword", name="changePassword")
     */
    public function changePasswordAction()
    {
        $peticion = Request::createFromGlobals();
        $username = $peticion->request->get('username');
        $passAnt = $peticion->request->get('passAnt');
        $passNew = $peticion->request->get('passNew');
        $usuario = $this->getUser();

        $encoder = $this->container->get('security.password_encoder');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Usuario');
        $user = $repository->findOneBy(array('username' => $username));
        $valid = $encoder->isPasswordValid($user , $passAnt);

        if($valid == 1)
        {
            $resp = $em->getRepository('AppBundle:Usuario')->cambiarPassword($username , $passNew);
            if(is_string($resp)) return new Response($resp);
            else{
                $dataTraza = array(
                    'username' => $usuario->getUsername(),
                    'nombre' => $usuario->getPersona()->getNombres(),
                    'operacion' => 'Insertar Usuario',
                    'descripcion' => 'Se insertó el usuario: '.$user->getPersona()->getNombres(). ' '. $user->getPersona()->getApellido1(). ' '.$user->getPersona()->getApellido2()
                );
                $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
                if($traza != 'ok') return new Response($traza);
                return new Response('ok');
            }
        }
        else
        {
            return new Response('Error: Contraseña actual errónea');
        }
    }



    //metodo para mostrar pantalla de bloqueo
    /**
     * @Route("/lock", name="lock")
     */
    public function lockAction()
    {
        return $this->render('Inicio/lock.html.twig');
    }

    //metodo para desbloquear el sistema
    /**
     * @Route("/confirmPassword", name="confirmPassword")
     */
    public function confirmPasswordAction()
    {
        $peticion = Request::createFromGlobals();
        $password = $peticion->request->get('password');
        $user = $this->getUser();

        $encoder = $this->container->get('security.password_encoder');

        /*$em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Usuario');
        $user = $repository->findOneBy(array('username' => $username));*/
        $valid = $encoder->isPasswordValid($user , $password);

        if($valid == 1)
        {
            return new Response('ok');
        }
        else
        {
            return new Response('Error: Contraseña  errónea');
        }
    }


}
