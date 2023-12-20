<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PagoController extends Controller
{
    /**
     * @Route("/mandamientosPagosEnProceso", name="mandamientosPagosEnProceso")
     */
    public function mandamientosPagosEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarMandamientosPagosEnProceso($user);
        $totalMandamientos = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->totalMandamientosPagosEnProceso($user);

        return $this->render('MandamientoPago/mandamientosPagosEnProceso.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMandamientos' => $totalMandamientos,
        ));

    }

    /**
     * @Route("/pagosDirectosEnProceso", name="pagosDirectosEnProceso")
     */
    public function pagosDirectosEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarPagosDirectosEnProceso($user);
        $totalMandamientos = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->totalPagosDirectosEnProceso($user);

        return $this->render('MandamientoPago/pagosDirectosEnProceso.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMandamientos' => $totalMandamientos,
        ));

    }

    /**
     * @Route("/mandamientosPagosProcesados", name="mandamientosPagosProcesados")
     */
    public function mandamientosPagosProcesadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarMandamientosPagosProcesados();
        $totalMandamientos = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->totalMandamientosPagosProcesados($user);

        return $this->render('MandamientoPago/mandamientosPagosProcesados.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMandamientos' => $totalMandamientos,
        ));

    }

    /**
     * @Route("/pagosDirectosProcesados", name="pagosDirectosProcesados")
     */
    public function pagosDirectosProcesadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarPagosDirectosProcesados();
        $totalMandamientos = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->totalPagosDirectosProcesados($user);


        return $this->render('MandamientoPago/pagosDirectosProcesados.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMandamientos' => $totalMandamientos,
        ));

    }

    /**
     * @Route("/insertMandamientoPago", name="insertMandamientoPago")
     */
    public function insertMandamientoPagoAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $partidas  = $peticion->request->get('partidas');
        $idExpediente =  $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);

        $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->modificarPresupuestoServicioExpediente($expediente , $partidas , $user);
        if($partidaExp != 'ok') return new Response($partidaExp);

        $nombreSeccion = $peticion->request->get('nombreSeccion');

        $result = $em->getRepository('AppBundle:Expedientes')->regularizarExpediente($nombreSeccion , $expediente);
        if($result != 'ok') return new Response($result);

        $data = array(
            'expediente' => $expediente,
            'pagoDirecto' => $peticion->request->get('pagoDirecto'),
            'montoAPagar' => $peticion->request->get('montoAPagar'),
            'numeroMandamientoPago' => $peticion->request->get('numeroMandamientoPago'),
            'fechaMandamientoPago' => $peticion->request->get('fechaMandamientoPago'),
        );

        $mandamientoPago = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->agregarMandamientoPago($data , $user);
        if(is_string($mandamientoPago)) return new Response($mandamientoPago);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Insertar Mandamiento de Pago',
                'descripcion' => 'Se insertó un mandamiento de pago para el expediente con número: '.$mandamientoPago->getExpediente()->getNumeroexpediente() .' y fecha  '.$mandamientoPago->getExpediente()->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/aprobarMandamientoPago", name="aprobarMandamientoPago")
     */
    public function aprobarMandamientoPagoAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idExpediente =  $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $partidas  = $peticion->request->get('partidas');

        $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->modificarPresupuestoServicioExpediente($expediente , $partidas , $user);
        if($partidaExp != 'ok') return new Response($partidaExp);

        $nombreSeccion = $peticion->request->get('nombreSeccion');

        $result = $em->getRepository('AppBundle:Expedientes')->regularizarExpediente($nombreSeccion , $expediente);
        if($result != 'ok') return new Response($result);

        if($user->getInstancia()->getPreorden() == '4')
        {
            $valorEjecutado = $em->getRepository('AppBundle:Presupuestosservicios')->aumentarValorEjecutadoPartidas($partidas);
            if($valorEjecutado != 'ok') return new Response($valorEjecutado);
        }

        $data = array(
            'expediente' => $expediente,
            'montoAPagar' => $peticion->request->get('montoAPagar'),
            'idMandamientoPago' => $peticion->request->get('idMandamientoPago'),
        );

        $expediente = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->aprobarMandamientoPago($data , $user);
        if(is_string($expediente)) return new Response($expediente);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Aprobar Mandamiento de Pago',
                'descripcion' => 'Se aprobó el mandamiento de pago del expediente con número: '.$expediente->getNumeroexpediente() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/desestimarMandamientoPago", name="desestimarMandamientoPago")
     */
    public function desestimarMandamientoPagoAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idExpediente = $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $partidas  = $peticion->request->get('partidas');

        $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->modificarPresupuestoServicioExpediente($expediente , $partidas , $user);
        if($partidaExp != 'ok') return new Response($partidaExp);

        $valorDisponible = $em->getRepository('AppBundle:Presupuestosservicios')->disminuirValorDisponiblePartidas($partidas);
        if($valorDisponible != 'ok') return new Response($valorDisponible);

        $expediente = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->desestimarMandamientoPago($expediente , $user);
        if(is_string($expediente)) return new Response($expediente);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Desestimar Mandamiento de Pago',
                'descripcion' => 'Se desestimó el mandamiento de pago del expediente con número: '.$expediente->getNumeroexpediente() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }
}
