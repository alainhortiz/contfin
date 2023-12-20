<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PresupuestoController extends Controller
{
    /**
     * @Route("/presupuestoPorSecciones", name="presupuestoPorSecciones")
     */
    public function presupuestoPorSeccionesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoEjecutado();
        $totalDisponible =  $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoDisponible();
        $totalEjecutado =  $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoEjecutado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();
        $totalSecciones = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoTotalPorSeccion();

        return $this->render('Presupuesto/presupuestoPorSecciones.html.twig', array(

            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'totalDisponible' => $totalDisponible,
            'totalEjecutado' => $totalEjecutado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'totalSecciones' => $totalSecciones,
        ));
    }

    /**
     * @Route("/verPresupuestoSeccion/{idSeccion}", name="verPresupuestoSeccion")
     */
    public function verPresupuestoSeccionAction($idSeccion)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();
        $presupuestosServiciosSeccion = $em->getRepository('AppBundle:Presupuestosservicios')->listarServiciosSeccion($idSeccion);
        $totalPresupuestosServiciosSeccion = $em->getRepository('AppBundle:Presupuestosservicios')->totalPresupuestoServiciosSeccion($idSeccion);
        $seccion = $em->getRepository('AppBundle:Secciones')->find($idSeccion);

        return $this->render('Presupuesto/presupuestoPorServiciosSeccion.html.twig', array(

            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'presupuestosServiciosSeccion' => $presupuestosServiciosSeccion,
            'seccion' => $seccion,
            'totalPresupuestosServiciosSeccion' => $totalPresupuestosServiciosSeccion,
        ));
    }

    /**
     * @Route("/verPresupuestoServicio/{idServicio}", name="verPresupuestoServicio")
     */
    public function verPresupuestoServicioAction($idServicio)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();
        $servicio = $em->getRepository('AppBundle:Servicios')->find($idServicio);
        $presupuestosServicios= $em->getRepository('AppBundle:Presupuestosservicios')->listarNEServicio($idServicio);
        $totalPresupuestosNEServicio = $em->getRepository('AppBundle:Presupuestosservicios')->totalPresupuestoNEServicio($idServicio);

        return $this->render('Presupuesto/presupuestoPorNeServicio.html.twig', array(

            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'presupuestosServicios' => $presupuestosServicios,
            'servicio' => $servicio,
            'totalPresupuestosNEServicio' => $totalPresupuestosNEServicio,
        ));
    }

    /**
     * @Route("/aplicarPorcientoReserva", name="aplicarPorcientoReserva")
     */
    public function aplicarPorcientoReservaAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $porciento =  $peticion->request->get('porciento');
        $configuracion = $em->getRepository('AppBundle:Porcentajereservaannos')->modificarPorcientoReserva($porciento);

        if(is_string($configuracion)) return new Response($configuracion);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Modificar Porciento de Reserva',
                'descripcion' => 'Se modificó el porciento de reserva del presupuesto a : '.$configuracion->getPorcentajereserva()
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/presupuestosNeSeccion", name="presupuestosNeSeccion")
     */
    public function presupuestosNeSeccionAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();

        $idSeccion = $peticion->request->get('idSeccion');
        $presupuestosNeSeccion = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestosNeSeccion($idSeccion);

        return $this->render('Presupuesto/tablaPresupuestoNeSeccion.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'idSeccion' => $idSeccion,
            'presupuestosNeSeccion' => $presupuestosNeSeccion
        ));
    }

    /**
     * @Route("/presupuestosProyectosServicio/{idServicio}", name="presupuestosProyectosServicio")
     */
    public function presupuestosProyectosServicioAction($idServicio)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();
        $servicio = $em->getRepository('AppBundle:Servicios')->find($idServicio);
        $presupuestosProyectosServicio= $em->getRepository('AppBundle:Presupuestosservicios')->listarProyectosServicio($idServicio);
        $totalPresupuestosProyectosServicio = $em->getRepository('AppBundle:Presupuestosservicios')->totalPresupuestoProyectosServicio($idServicio);

        return $this->render('Presupuesto/presupuestoProyectosServicio.html.twig', array(

            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'presupuestosProyectosServicio' => $presupuestosProyectosServicio,
            'servicio' => $servicio,
            'totalPresupuestosProyectosServicio' => $totalPresupuestosProyectosServicio,
        ));
    }

    /**
     * @Route("/ponerConfidencialSeccion", name="ponerConfidencialSeccion")
     */
    public function ponerConfidencialSeccionAction()
    {
        $peticion = Request::createFromGlobals();
        $user = $this->getUser();

        $idSeccion = $peticion->request->get('idSeccion');
        $confidencial = $peticion->request->get('confidencial');
        $em = $this->getDoctrine()->getManager();

        $seccion = $em->getRepository('AppBundle:Secciones')->ponerSeccionConfidencial($idSeccion , $confidencial);
        if(is_string($seccion)) return new Response($seccion);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Poner Sección Confidencial',
                'descripcion' => 'La sección con nombre : '.$seccion->getNombreseccion().' se puso como confidencial'
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/ajustePresupuesto", name="ajustePresupuesto")
     */
    public function ajustePresupuestoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicialCapituloII = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicialCapituloII();
        $totalGastadoCapituloII = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoEjecutadoCapituloII();
        $totalDisponibleCapituloII =  $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoDisponibleCapituloII();
        $totalEjecutadoCapituloII =  $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoEjecutadoCapituloII();
        $cantidadPartidasFondosCapituloII = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondosCapituloII();
        $cantidadPartidasSinUsoCapituloII = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsosCapituloII();
        $partidasCapituloII = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoPartidasCapituloII();

        return $this->render('Presupuesto/ajustePresupuesto.html.twig', array(

            'tipoMoneda' => $tipoMoneda,
            'totalInicialCapituloII' => $totalInicialCapituloII,
            'totalGastadoCapituloII' => $totalGastadoCapituloII,
            'totalDisponibleCapituloII' => $totalDisponibleCapituloII,
            'totalEjecutadoCapituloII' => $totalEjecutadoCapituloII,
            'cantidadPartidasFondos' => $cantidadPartidasFondosCapituloII,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUsoCapituloII,
            'partidasCapituloII' => $partidasCapituloII,
        ));
    }

    /**
     * @Route("/cambiarPresupuesto", name="cambiarPresupuesto")
     */
    public function cambiarPresupuestoAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();

        $data = array(
            'idPresupuestoAnterior' => $peticion->request->get('idPresupuestoAnterior'),
            'monto' => $peticion->request->get('monto'),
            'idPresupuestoNuevo' => $peticion->request->get('idPresupuestoNuevo'),
        );

        $cambiarPresupuesto = $em->getRepository('AppBundle:Presupuestosservicios')->cambiarPresupuesto($data);

        if($cambiarPresupuesto !== 'ok'){
            return new Response($cambiarPresupuesto);
        }

        return new Response('ok');
    }





}
