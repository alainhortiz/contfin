<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraficosController extends Controller
{
    /**
     * @Route("/servicioSeccion", name="servicioSeccion")
     */
    public function servicioSeccionAction()
    {
        $peticion = Request::createFromGlobals();
        $seccion = $peticion->request->get('seccion');

        $em = $this->getDoctrine()->getManager();

        $graficosPresupuestosServicios  = $em->getRepository('AppBundle:Presupuestosservicios')->graficoSeccionServiciosPresupuestos($seccion);

        if(is_string($graficosPresupuestosServicios))  return new Response($graficosPresupuestosServicios);
        else{
            $result = json_encode($graficosPresupuestosServicios);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/servicioPresupuestoGastado", name="servicioPresupuestoGastado")
     */
    public function servicioPresupuestoGastadoAction()
    {
        $peticion = Request::createFromGlobals();
        $servicio = $peticion->request->get('servicio');

        $em = $this->getDoctrine()->getManager();

        $presupuestosServicioGastado  = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoServicioGastado($servicio);

        if(is_string($presupuestosServicioGastado))  return new Response($presupuestosServicioGastado);
        else{
            $result = json_encode($presupuestosServicioGastado);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/instanciaEstado", name="instanciaEstado")
     */
    public function instanciaEstadoAction()
    {
        $peticion = Request::createFromGlobals();
        $estado = $peticion->request->get('estado');

        $em = $this->getDoctrine()->getManager();

        $graficosInstanciasEstados  = $em->getRepository('AppBundle:Expedientes')->graficoInstancias($estado);

        if(is_string($graficosInstanciasEstados))  return new Response($graficosInstanciasEstados);
        else{
            $result = json_encode($graficosInstanciasEstados);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/montoExpediente", name="montoExpediente")
     */
    public function montoExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $tipo = $peticion->request->get('tipo');

        $em = $this->getDoctrine()->getManager();

        $graficosMontosExpedientes  = $em->getRepository('AppBundle:Expedientes')->graficoExpedientesMontos($tipo);

        if(is_string($graficosMontosExpedientes))  return new Response($graficosMontosExpedientes);
        else{
            $result = json_encode($graficosMontosExpedientes);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/actividadFecha", name="actividadFecha")
     */
    public function actividadFechaAction()
    {
        $peticion = Request::createFromGlobals();
        $fechaInicial = $peticion->request->get('fechaInicial');
        $fechaFinal = $peticion->request->get('fechaFinal');

        $em = $this->getDoctrine()->getManager();

        $actividadesHoy  = $em->getRepository('AppBundle:Expedientes')->actividadesFecha($fechaInicial,$fechaFinal);

        if(is_string($actividadesHoy)) return new Response($actividadesHoy);
        else return new Response($this->renderView('Inicio/tablaActividades.html.twig', array('actividadesHoy' => $actividadesHoy)));

    }

    /**
     * @Route("/expedienteImporteServicio", name="expedienteImporteServicio")
     */
    public function expedienteImporteServicioAction()
    {
        $peticion = Request::createFromGlobals();
        $expediente = $peticion->request->get('expediente');

        $em = $this->getDoctrine()->getManager();

        $graficosMontosExpedienteServicios  = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->graficoExpedientesImportesServicios($expediente);

        if(is_string($graficosMontosExpedienteServicios))  return new Response($graficosMontosExpedienteServicios);
        else{
            $result = json_encode($graficosMontosExpedienteServicios);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/instanciaExpediente", name="instanciaExpediente")
     */
    public function instanciaExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $expediente = $peticion->request->get('expediente');

        $em = $this->getDoctrine()->getManager();

        $graficosInstanciasExpedientes  = $em->getRepository('AppBundle:Expedientes')->graficoExpedienteInstancias($expediente);

        if(is_string($graficosInstanciasExpedientes))  return new Response($graficosInstanciasExpedientes);
        else{
            $result = json_encode($graficosInstanciasExpedientes);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/seccionExpediente", name="seccionExpediente")
     */
    public function seccionExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $seccion = $peticion->request->get('seccion');

        $em = $this->getDoctrine()->getManager();

        $graficosSeccionExpedientes  = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->graficoExpedientesSecciones($seccion);

        if(is_string($graficosSeccionExpedientes))  return new Response($graficosSeccionExpedientes);
        else{
            $result = json_encode($graficosSeccionExpedientes);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/servicioExpediente", name="servicioExpediente")
     */
    public function servicioExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $servicio = $peticion->request->get('servicio');

        $em = $this->getDoctrine()->getManager();

        $graficosServicioExpedientes  = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->graficoExpedientesServicios($servicio);

        if(is_string($graficosServicioExpedientes))  return new Response($graficosServicioExpedientes);
        else{
            $result = json_encode($graficosServicioExpedientes);
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/expedienteInstancia", name="expedienteInstancia")
     */
    public function expedienteInstanciaAction()
    {
        $peticion = Request::createFromGlobals();
        $instancia = $peticion->request->get('instancia');

        $em = $this->getDoctrine()->getManager();

        $graficosExpedientesInstancia  = $em->getRepository('AppBundle:Expedientes')->graficoInstanciaExpedientes($instancia);

        if(is_string($graficosExpedientesInstancia))  return new Response($graficosExpedientesInstancia);
        else{
            $result = json_encode($graficosExpedientesInstancia);
            return new JsonResponse($result);
        }

    }
}
