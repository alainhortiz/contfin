<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/gestionarUsuarios", name="gestionarUsuarios")
     */
    public function gestionarUsuariosAccion()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $usuarios = $em->getRepository('AppBundle:Usuario')->findBy(array('isactive' => true));

        return $this->render('Nomencladores/GestionUsuario/gestionUsuarios.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'usuarios' => $usuarios
        ));
    }

    /**
     * @Route("/addUsuario", name="addUsuario")
     */
    public function addUsuarioAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $instancias = $em->getRepository('AppBundle:Instancias')->findAll();
        $roles = $em->getRepository('AppBundle:Role')->findAll();

        return $this->render('Nomencladores/GestionUsuario/addUsuario.html.twig' , array(
                'tipoMoneda' => $tipoMoneda,
                'totalInicial' => $totalInicial,
                'totalGastado' => $totalGastado,
                'cantidadPartidasFondos' => $cantidadPartidasFondos,
                'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
                'roles' => $roles,
                'instancias' => $instancias)
        );
    }
    /**
     * @Route("/insertUsuario", name="insertUsuario")
     */
    public function insertUsuarioAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $data = array(
            'username' => $peticion->request->get('username'),
            'nombre' => $peticion->request->get('nombre'),
            'primerApellido' => $peticion->request->get('primerApellido'),
            'segundoApellido' => $peticion->request->get('segundoApellido'),
            'instancia' => $peticion->request->get('instancia'),
            'email' => $peticion->request->get('email'),
            'telefono' => $peticion->request->get('telefono'),
            'roles' => $peticion->request->get('roles')
        );
        $resp = $em->getRepository('AppBundle:Usuario')->agregarUsuario($data);

        if(is_string($resp)) return new Response($resp);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Insertar Usuario',
                'descripcion' => 'Se insertó el usuario: '.$data['nombre']. ' '. $data['primerApellido']. ' '.$data['segundoApellido']
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/editUsuario/{idUsuario}", name="editUsuario")
     */
    public function editUsuarioAction($idUsuario)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);
        $instancias = $em->getRepository('AppBundle:Instancias')->findAll();
        $roles = $em->getRepository('AppBundle:Role')->findAll();


        return $this->render('Nomencladores/GestionUsuario/editUsuario.html.twig' , array(
                'tipoMoneda' => $tipoMoneda,
                'totalInicial' => $totalInicial,
                'totalGastado' => $totalGastado,
                'cantidadPartidasFondos' => $cantidadPartidasFondos,
                'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
                'usuario' => $usuario,
                'roles' => $roles,
                'instancias' => $instancias)
        );
    }

    /**
     * @Route("/updateUsuario", name="updateUsuario")
     */
    public function updateUsuarioAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $data = array(

            'idUsuario' => $peticion->request->get('idUsuario'),
            'username' => $peticion->request->get('username'),
            'nombre' => $peticion->request->get('nombre'),
            'primerApellido' => $peticion->request->get('primerApellido'),
            'segundoApellido' => $peticion->request->get('segundoApellido'),
            'instancia' => $peticion->request->get('instancia'),
            'email' => $peticion->request->get('email'),
            'telefono' => $peticion->request->get('telefono'),
            'roles' => $peticion->request->get('roles')
        );

        $resp = $em->getRepository('AppBundle:Usuario')->modificarUsuario($data);

        if(is_string($resp)) return new Response($resp);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Modificar Usuario',
                'descripcion' => 'Se modificó el usuario: '.$data['nombre']. ' '. $data['primerApellido']. ' '.$data['segundoApellido']
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/deleteUsuario", name="deleteUsuario")
     */
    public function deleteUsuarioAccion()
    {
        $peticion = Request::createFromGlobals();
        $user = $this->getUser();
        $idUsuario = $peticion->request->get('idUsuario');
        $em = $this->getDoctrine()->getManager();

        $resp  = $em->getRepository('AppBundle:Usuario')->eliminarUsuario($idUsuario);

        if(is_string($resp)) return new Response($resp);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Eliminar Usuario',
                'descripcion' => 'Se eliminó el usuario: '.$resp->getPersona()->getNombres(). ' ' .$resp->getPersona()->getApellido1(). ' '.$resp->getPersona()->getApellido2()
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/desactivarUsuario", name="desactivarUsuario")
     */
    public function desactivarUsuarioAccion()
    {
        $peticion = Request::createFromGlobals();
        $user = $this->getUser();
        $idUsuario = $peticion->request->get('idUsuario');
        $em = $this->getDoctrine()->getManager();

        $resp  = $em->getRepository('AppBundle:Usuario')->desactivarrUsuario($idUsuario);

        if(is_string($resp)) return new Response($resp);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Desactivar Usuario',
                'descripcion' => 'Se desactivó el usuario: '.$resp->getPersona()->getNombres(). ' ' .$resp->getPersona()->getApellido1(). ' '.$resp->getPersona()->getApellido2()
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

}
