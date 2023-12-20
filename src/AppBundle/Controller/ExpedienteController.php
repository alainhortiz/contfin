<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpedienteController extends Controller
{


    /**
     * @Route("/mostrarBuscadorExpediente", name="mostrarBuscadorExpediente")
     */
    public function mostrarBuscadorExpedienteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $secciones = $em->getRepository('AppBundle:Secciones')->findAll();
        $servicios = $em->getRepository('AppBundle:Servicios')->findAll();
        $estados = $em->getRepository('AppBundle:Estadosexpedientes')->findAll();
        $numerosEconomicos = $em->getRepository('AppBundle:Numeroseconomicos')->listarNumerosEconomicos();

        return $this->render('Expediente/buscadorExpediente.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'secciones' => $secciones,
            'servicios' => $servicios,
            'numerosEconomicos' => $numerosEconomicos,
            'estados' => $estados,

        ));
    }

    /**
     * @Route("/localizarExpediente", name="localizarExpediente")
     */
    public function localizarExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();

        $data = array(
            'fechaInicial' => $peticion->request->get('fechaInicial'),
            'fechaFinal' => $peticion->request->get('fechaFinal'),
            'operacion' => $peticion->request->get('operacion'),
            'numeroExpediente' => $peticion->request->get('numeroExpediente'),
            'numeroEconomico' => $peticion->request->get('numeroEconomico'),
            'numeroRegistro' => $peticion->request->get('numeroRegistro'),
            'importeSolicitado' => $peticion->request->get('importeSolicitado'),
            'beneficiario' => $peticion->request->get('beneficiario'),
            'seccion' => $peticion->request->get('seccion'),
            'servicio' => $peticion->request->get('servicio'),
            'estadoExpediente' => $peticion->request->get('estadoExpediente'),
        );
        $expedientes = $em->getRepository('AppBundle:Expedientes')->buscarExpediente($data);

        $datos = json_encode($data);

        if(is_string($expedientes)) return new Response($expedientes);
        else return new Response($this->renderView('Expediente/tablaExpedientesEncontrados.html.twig', array(
            'expedientes' => $expedientes,
            'data' => $datos,
            'tipoMoneda'=> $tipoMoneda
        )));
    }

    /**
     * @Route("/listadoExpedientes", name="listadoExpedientes")
     */
    public function listadoExpedientesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes = $em->getRepository('AppBundle:Expedientes')->findBy(array('activo' => true));
        $totalMontoExpedientes = $em->getRepository('AppBundle:Expedientes')->totalListadoExpediente();

        return $this->render('Expediente/listadoExpedientes.htm.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientes' => $totalMontoExpedientes
        ));
    }

    /**
     * @Route("/expedientesPorSupervisar", name="expedientesPorSupervisar")
     */
    public function expedientesPorSupervisarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $instancia =$user->getInstancia()->getId();
        $expedientes =$em->getRepository('AppBundle:Expedientes')->listarExpedientesPorSupervisar($instancia);
        $totalMontoExpedientesPorSupervisar = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedientePorSupervisar($instancia);
        return $this->render('Expediente/listadoExpedientesPorSupervisar.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientesPorSupervisar' => $totalMontoExpedientesPorSupervisar
        ));
    }

    /**
     * @Route("/expedientesPorProcesar", name="expedientesPorProcesar")
     */
    public function expedientesPorProcesarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $instancia =$user->getInstancia()->getId();
        $expedientes =$em->getRepository('AppBundle:Expedientes')->listarExpedientesPorProcesar($instancia);
        $totalMontoExpedientesPorProcesar = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedientePorProcesar($instancia);
        return $this->render('Expediente/listadoExpedientesPorProcesar.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientesPorProcesar' => $totalMontoExpedientesPorProcesar
        ));
    }

    /**
     * @Route("/expedientesEnProceso", name="expedientesEnProceso")
     */
    public function expedientesEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $expedientes =$em->getRepository('AppBundle:Expedientes')->listarExpedientesEnProceso($user);
        $totalMontoExpedientesEnProceso = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedienteEnProceso($user);
        return $this->render('Expediente/listadoExpedientesEnProceso.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientesEnProceso' => $totalMontoExpedientesEnProceso
        ));
    }

    /**
     * @Route("/expedientesDesestimados", name="expedientesDesestimados")
     */
    public function expedientesDesestimadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $instancia =$user->getInstancia()->getId();
        $expedientes =$em->getRepository('AppBundle:Expedientes')->listarExpedientesDesestimados($instancia);
        $totalMontoExpedientesDesestimados = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedienteDesestimados($instancia);
        return $this->render('Expediente/listadoExpedientesDesestimados.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientesDesestimados' => $totalMontoExpedientesDesestimados
        ));
    }

    /**
     * @Route("/expedientesSinCredito", name="expedientesSinCredito")
     */
    public function expedientesSinCreditoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $user = $this->getUser();
        $instancia = $user->getInstancia()->getId();
        $expedientes =$em->getRepository('AppBundle:Expedientes')->listarExpedientesSinCredito($instancia);
        $totalMontoExpedientesSinCredito = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedienteSinCredito($instancia);

        return $this->render('Expediente/listadoExpedientesSinCredito.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expedientes' => $expedientes,
            'totalMontoExpedientesSinCredito' => $totalMontoExpedientesSinCredito
        ));
    }

    /**
     * @Route("/expedientesPorInstancia", name="expedientesPorInstancia")
     */
    public function expedientesPorInstanciaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $peticion = Request::createFromGlobals();
        $instancias = $em->getRepository('AppBundle:Instancias')->findAll();

        if($peticion->request->get('instancia') == null){
            $user = $this->getUser();
            $idInstancia = $user->getInstancia()->getId();
            $expedientes = $em->getRepository('AppBundle:Expedientes')->listarExpedientesPorInstancia($idInstancia);
            $totalMontoExpedientesPorInstancia = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedientePorInstancia($idInstancia);

            return $this->render('Expediente/listadoExpedientesPorInstancia.html.twig' , array(
                'tipoMoneda' => $tipoMoneda,
                'totalInicial' => $totalInicial,
                'totalGastado' => $totalGastado,
                'cantidadPartidasFondos' => $cantidadPartidasFondos,
                'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
                'instancias' => $instancias,
                'expedientes' => $expedientes,
                'totalMontoExpedientesPorInstancia' => $totalMontoExpedientesPorInstancia
            ));
        }else{

            $idInstancia = $peticion->request->get('instancia');
            $instancia = $em->getRepository('AppBundle:Instancias')->find($idInstancia);
            $expedientes = $em->getRepository('AppBundle:Expedientes')->listarExpedientesPorInstancia($idInstancia);
            $totalMontoExpedientesPorInstancia = $em->getRepository('AppBundle:Expedientes')->totalListadoExpedientePorInstancia($idInstancia);
            return $this->render('Expediente/tablaExpedientesEncontradosInstancia.html.twig' , array(
                'tipoMoneda' => $tipoMoneda,
                'instancia' => $instancia,
                'instancias' => $instancias,
                'expedientes' => $expedientes,
                'totalMontoExpedientesPorInstancia' => $totalMontoExpedientesPorInstancia
            ));
        }
    }

    /**
     * @Route("/verExpediente/{idExpediente}/{ruta}", name="verExpediente")
     */
    public function verExpedienteAction($idExpediente  , $ruta = null)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $user = $this->getUser();
        $instancia = $user->getInstancia();
        $parametrizacion = $em->getRepository('AppBundle:Parametrizacionexpedientes')->findOneBy(array('expediente' => $expediente , 'instancia' => $instancia));
        $parametrosInstancia = $em->getRepository('AppBundle:Parametrosinstancias')->findBy(array('instancia' => $instancia));
        $partidas = $expediente->getPartidas();
        $expedientesFichaControl = count($partidas) != 0 ? $em->getRepository('AppBundle:Expedientes')->listarFichaControl($partidas[0]->getPresupuestoservicio()->getId() , $expediente->getId()) : '';
        $servicios = $em->getRepository('AppBundle:Servicios')->listarServiciosAddExpediente();
        $numerosEconomicos = $em->getRepository('AppBundle:Numeroseconomicos')->listarNumerosEconomicos();
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestosServiciosConFondo();
        $vinculo = $em->getRepository('AppBundle:Configuracionesgenerales')->getDireccionAdjuntos();
        $secciones = $em->getRepository('AppBundle:Secciones')->listarSecciones();
        $presupuestosNeSeccion = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestosNeSeccion($secciones[0]->getId());
        $presupuestosSecciones = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoTotalPorSeccion();
        $actual = new \DateTime('now');
        $year = $actual->format('Y');
        $proyectos = $em->getRepository('AppBundle:Presupuestosproyectos')->findBy(array('anno' => $year));

        $role = $em->getRepository('AppBundle:Role')->findOneBy(array('nombre' => 'ROLE_PROCESADOR'));
        if($user->getUsuarioRoles()->contains($role))
        {
            if(($expediente->getEstadoexpedienteinstancia()->getEstadoexpediente()->getNombreestado() == 'POR PROCESAR' or  $expediente->getEstadoexpedienteinstancia()->getEstadoexpediente()->getNombreestado() == 'CREADO')
                and $instancia->getId() == $expediente->getEstadoexpedienteinstancia()->getInstancia()->getId() and $instancia->getPreorden() != '6')
            {
                $em->getRepository('AppBundle:Expedientes')->reservarExpediente($expediente , $user);
            }
        }

        return $this->render('Expediente/verExpediente.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'ruta' => $ruta,
            'expediente' => $expediente,
            'parametrosInstancia' => $parametrosInstancia,
            'parametrizacion' => $parametrizacion,
            'servicios' => $servicios,
            'numerosEconomicos' => $numerosEconomicos,
            'presupuestos' => $presupuestos,
            'expedientesFichaControl' => $expedientesFichaControl,
            'vinculo' => $vinculo,
            'secciones' => $secciones,
            'presupuestosNeSeccion' => $presupuestosNeSeccion,
            'presupuestosSecciones' => $presupuestosSecciones,
            'proyectos' => $proyectos,
        ));
    }

    /**
     * @Route("/expedientesFichaControl", name="expedientesFichaControl")
     */
    public function expedientesFichaControlAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $idExpediente = $peticion->request->get('idExpediente');
        $idPresupuesto = $peticion->request->get('presupuestoServicio');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->listarFichaControl($idPresupuesto , $idExpediente);

        return $this->render('Expediente/fichaControl.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'idPresupuesto' => $idPresupuesto,
            'expedientesFichaControl' => $expedientes
        ));
    }

    /**
     * @Route("/addExpediente", name="addExpediente")
     */
    public function addExpedienteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $ministerios = $em->getRepository('AppBundle:Ministerios')->findAll();
        $seccionPorDefecto = $em->getRepository('AppBundle:Secciones')->findOneBy(array('codigoseccion' => '07'));
        $ministerioPorDefecto = $em->getRepository('AppBundle:Ministerios')->findOneBy(array('seccion' => $seccionPorDefecto));

        $servicios = $em->getRepository('AppBundle:Servicios')->listarServiciosAddExpediente();
        $numerosEconomicos = $em->getRepository('AppBundle:Numeroseconomicos')->listarNumerosEconomicos();
        $actual = new \DateTime('now');
        $year = $actual->format('Y');
        $proyectos = $em->getRepository('AppBundle:Presupuestosproyectos')->findBy(array('anno' => $year));
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestosServiciosConFondo();
        $next = $em->getRepository('AppBundle:Expedientes')->getNextNumeroExpediente();
        $actual = new \DateTime('now');
        $nextNumero = $actual->format('Y').' - '.$next;
        $nexUbicacion = $em->getRepository('AppBundle:Expedientes')->getNextUbicacionArchivo();

        return $this->render('Expediente/addExpediente.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'ministerios' => $ministerios,
            'ministerioPorDefecto' => $ministerioPorDefecto,
            'servicios' => $servicios,
            'numerosEconomicos' => $numerosEconomicos,
            'presupuestos' => $presupuestos,
            'nextNumero' => $nextNumero,
            'nexUbicacion' => $nexUbicacion,
            'proyectos' => $proyectos,
        ));
    }

    /**
     * @Route("/insertExpediente", name="insertExpediente")
     */
    public function insertExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $dataExpediente = array(
            'prioritario' => $peticion->request->get('prioritario'),
            'fechaEntrada' => $peticion->request->get('fechaEntrada'),
            'montoSolicitado' => $peticion->request->get('montoSolicitado'),
            'resumen' => $peticion->request->get('resumen'),
            'beneficiario' => $peticion->request->get('beneficiario'),
            'descripcion' => $peticion->request->get('descripcion'),
            'observaciones' => $peticion->request->get('observaciones'),
            'nombreSeccion' => $peticion->request->get('nombreSeccion'),
            'ubicacionArchivo' => $peticion->request->get('ubicacionArchivo'),
        );
        //agregar el expediente
        $expediente = $em->getRepository('AppBundle:Expedientes')->agregarExpediente($dataExpediente , $user);
        if(is_string($expediente)) return new Response($expediente);
        // agregar los registros
        $registros  = $peticion->request->get('registros');

        if($registros)
        {
            $registroExp = $em->getRepository('AppBundle:Registrosexpedientes')->agregarRegistro($expediente , $registros);

            if($registroExp != 'ok'){
                $em->remove($expediente);
                $em->flush();
                return new Response($registroExp);
            }
        }
        //agregar las partidas
        $partidas  = $peticion->request->get('partidas');

        if($partidas)
        {

            $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->agregarPresupuestoServicioExpediente($expediente , $partidas);

            if($partidaExp != 'ok') {
                $em->remove($expediente);
                $em->flush();
                return new Response($partidaExp);
            }

        }
        //si tiene proyectos se agregan
        foreach ($partidas as $partida)
        {
            if(isset($partida['proyectos']))
            {
                $proyectosExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientesproyectos')->agregarPresupuestoServicioExpedienteProyecto($expediente , $partida);
                if($proyectosExp != 'ok') {
                    $em->remove($expediente);
                    $em->flush();
                    return new Response($proyectosExp);
                }
            }
        }
        // si se crea en contabilidad se rebaja de la disponibilidad
        if($user->getInstancia()->getPreorden() == 6)
        {
            $valorDisponible = $em->getRepository('AppBundle:Presupuestosservicios')->aumentarValorDisponiblePartidas($partidas);
            if($valorDisponible != 'ok') return new Response($valorDisponible);
        }

        // si tiene adjuntos se agregan
        $adjuntos = $peticion->request->get('adjuntos');
        if($adjuntos)
        {
            foreach ($adjuntos as $adjunto)
            {
                $adjuntosExp = $em->getRepository('AppBundle:Documentos')->agregarEvidenciaDocumento($adjunto['idDocumento'] , $expediente->getId());

                if(is_string($adjuntosExp)) {
                    $em->remove($expediente);
                    $em->flush();
                    return new Response($adjuntosExp);
                }
            }
        }
        // se crea el historico
        $resp  = $em->getRepository('AppBundle:Historicosestadosexpedientes')->agregarHistoricoEstadoExpediente($expediente, $expediente->getEstadoexpedienteinstancia() , $user);
        if($resp !== 'ok')
        {
            $em->remove($expediente);
            $em->flush();
            return new Response($resp);
        }
        else{
            // traza
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Insertar nuevo expediente',
                'descripcion' => 'Se insertó un nuevo expediente con número: '.$expediente->getNumeroExpedienteMostrar() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza !== 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/actualizarExpediente", name="actualizarExpediente")
     */
    public function actualizarExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $idExpediente =  $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $partidas  = $peticion->request->get('partidas');

        if($user->getInstancia()->getPreorden() > 1)
        {
            $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->modificarPresupuestoServicioExpediente($expediente , $partidas , $user);
            if($partidaExp != 'ok') return new Response($partidaExp);
        }

        $nombreSeccion = $peticion->request->get('nombreSeccion');

        $result = $em->getRepository('AppBundle:Expedientes')->regularizarExpediente($nombreSeccion , $expediente);
        if($result != 'ok') return new Response($result);

        $data = array(
            'expediente' => $expediente,
            'dictamen' => $peticion->request->get('dictamen'),
            'montoAPagar' => $peticion->request->get('montoAPagar'),
            'prioritario' => $peticion->request->get('prioritario'),
            'parametros' => $peticion->request->get('parametros'),
        );
        $parametrizacion = $em->getRepository('AppBundle:Parametrizacionexpedientes')->parametrizarExpediente($data , $user);
        if(is_string($parametrizacion)) return new Response($parametrizacion);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Actualizar Expediente',
                'descripcion' => 'Se actualizó el  expediente con número: '.$expediente->getNumeroExpedienteMostrar() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/aprobarExpediente", name="aprobarExpediente")
     */
    public function aprobarExpedienteAction()
    {
        $actualizacion = $this->actualizarExpedienteAction();
        if ($actualizacion->getContent() != 'ok') return $actualizacion;

        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $idExpediente = $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $user = $this->getUser();
        $partidas  = $peticion->request->get('partidas');

        if($user->getInstancia()->getPreorden() > 1)
        {
            $resp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->comprobarFondoPartidasExpediente($partidas);
            if($resp != 'ok') return $this->render('Expediente/tablaPartidasSinFondo.html.twig' , array('presupuestosExpediente' => $resp ));
        }

        if($expediente->getEstadoexpedienteinstancia()->getInstancia()->getPreorden() == 2)
        {
            $valorDisponible = $em->getRepository('AppBundle:Presupuestosservicios')->aumentarValorDisponiblePartidas($partidas);
            if($valorDisponible != 'ok') return new Response($valorDisponible);
        }

        if($user->getInstancia()->getPreorden() == 4)
        {
            $this->forward('AppBundle:Export:exportarAprobadoPDF', array(
                'expediente' => $expediente
            ));
        }

        $expediente = $em->getRepository('AppBundle:Expedientes')->aprobarExpedienteInstancia($user , $expediente);
        if(is_string($expediente)) return new Response($expediente);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Aprobar expediente',
                'descripcion' => 'Se aprobó el expediente con número: '.$expediente->getNumeroexpediente() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/desestimarExpediente", name="desestimarExpediente")
     */
    public function desestimarExpedienteAction()
    {
        $actualizacion = $this->actualizarExpedienteAction();
        if ($actualizacion->getContent() != 'ok') return $actualizacion;

        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $idExpediente = $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $partidas  = $peticion->request->get('partidas');

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $lastInstancia = $expediente->getEstadoexpedienteinstancia()->getInstancia()->getPreorden();

        if( $lastInstancia > 2  or $expediente->getMandamientopago() == true)
        {
            $valorDisponible = $em->getRepository('AppBundle:Presupuestosservicios')->disminuirValorDisponiblePartidas($partidas);
            if($valorDisponible != 'ok') return new Response($valorDisponible);
        }

        if( $user->getInstancia()->getPreorden() == 3)
        {
            $this->forward('AppBundle:Export:exportarDesestimadoDirectorPDF', array(
                'expediente' => $expediente
            ));
        }

        if( $user->getInstancia()->getPreorden() == 4)
        {
            $this->forward('AppBundle:Export:exportarDesestimadoMinistroPDF', array(
                'expediente' => $expediente
            ));
        }

        $expediente = $em->getRepository('AppBundle:Expedientes')->desestimarExpedienteInstancia($user , $expediente);
        if(is_string($expediente)) return new Response($expediente);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Desestimar expediente',
                'descripcion' => 'Se desestimó el expediente con número: '.$expediente->getNumeroexpediente() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/buscarDuplicados", name="buscarDuplicados")
     */
    public function buscarDuplicadosAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();

        $data = array(
            'registros' => $peticion->request->get('registros'),
            'partidas' =>  $peticion->request->get('partidas'),
        );

        $duplicados = $em->getRepository('AppBundle:Expedientes')->buscarExpedientesDuplicados($data);

        if(is_string($duplicados)) return new Response($duplicados);

        if(count($duplicados) != 0) return new Response($this->renderView('Expediente/tablasExpedientesDuplicados.html.twig', array('expedientesDuplicados' => $duplicados)));
        else return $this->insertExpedienteAction();
    }

    /**
     * @Route("/editExpediente", name="editExpediente")
     */
    public function editExpedienteAction()
    {
        $idExpediente = $_POST['idExpedienteDuplicado'];
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $ministerios = $em->getRepository('AppBundle:Ministerios')->findAll();

        $servicios = $em->getRepository('AppBundle:Servicios')->listarServiciosAddExpediente();
        $numerosEconomicos = $em->getRepository('AppBundle:Numeroseconomicos')->listarNumerosEconomicos();
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestosServiciosConFondo();
        $actual = new \DateTime('now');
        $year = $actual->format('Y');
        $proyectos = $em->getRepository('AppBundle:Presupuestosproyectos')->findBy(array('anno' => $year));

        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);

        return $this->render('Expediente/editExpediente.html.twig', array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'expediente' => $expediente,
            'ministerios' => $ministerios,
            'servicios' => $servicios,
            'numerosEconomicos' => $numerosEconomicos,
            'presupuestos' => $presupuestos,
            'proyectos' => $proyectos
        ));
    }

    /**
     * @Route("/updateExpediente", name="updateExpediente")
     */
    public function updateExpedienteAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $dataExpediente = array(

            'idExpediente' => $peticion->request->get('idExpediente'),
            'prioritario' => $peticion->request->get('prioritario'),
            'montoSolicitado' => $peticion->request->get('montoSolicitado'),
            'resumen' => $peticion->request->get('resumen'),
            'beneficiario' => $peticion->request->get('beneficiario'),
            'descripcion' => $peticion->request->get('descripcion'),
            'observaciones' => $peticion->request->get('observaciones'),
            'nombreSeccion' => $peticion->request->get('nombreSeccion'),
            'ubicacionArchivo' => $peticion->request->get('ubicacionArchivo'),
        );

        $expediente = $em->getRepository('AppBundle:Expedientes')->modificarExpediente($dataExpediente , $user);
        if(is_string($expediente)) return new Response($expediente);

        $registros  = $peticion->request->get('registros');

        if($registros)
        {
            $registroExp = $em->getRepository('AppBundle:Registrosexpedientes')->agregarRegistro($expediente , $registros);

            if($registroExp != 'ok') return new Response($registroExp);

        }

        $partidas  = $peticion->request->get('partidas');
        if($partidas)
        {
            $partidaExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientes')->modificarPresupuestoServicioExpediente($expediente , $partidas , $user);
            if($partidaExp != 'ok') return new Response($partidaExp);

        }

        //si tiene proyectos se agregan
        foreach ($partidas as $partida)
        {
            if(isset($partida['proyectos']))
            {
                $proyectosExp = $em->getRepository('AppBundle:Presupuestosserviciosexpedientesproyectos')->agregarPresupuestoServicioExpedienteProyecto($expediente , $partida);
                if($proyectosExp != 'ok') {
                    $em->remove($expediente);
                    $em->flush();
                    return new Response($proyectosExp);
                }
            }
        }

        $resp  = $em->getRepository('AppBundle:Historicosestadosexpedientes')->agregarHistoricoEstadoExpediente($expediente, $expediente->getEstadoexpedienteinstancia() , $user);
        if($resp != 'ok')  return new Response($resp);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Modificar expediente duplicado',
                'descripcion' => 'Se modificó  expediente con número: '.$expediente->getNumeroExpedienteMostrar() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }
    }

    /**
     * @Route("/pasarExpedienteASinCredito", name="pasarExpedienteASinCredito")
     */
    public function pasarExpedienteASinCreditoAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idExpediente = $peticion->request->get('idExpediente');

        $expediente = $em->getRepository('AppBundle:Expedientes')->ponerExpedienteSinCredito($idExpediente , $user);
        if(is_string($expediente)) return new Response($expediente);
        else{
            $dataTraza = array(
                'username' => $user->getUsername(),
                'nombre' => $user->getPersona()->getNombres(),
                'operacion' => 'Expediente sin Crédito',
                'descripcion' => 'Se declaró SIN CREDITO el expediente con número: '.$expediente->getNumeroexpediente() .' y fecha  '.$expediente->getFechaentrada()->format('Y-m-d')
            );
            $traza = $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
            if($traza != 'ok') return new Response($traza);
            return new Response('ok');
        }

    }

    /**
     * @Route("/terminarExpediente/{idExpediente}/{ruta}", name="terminarExpediente")
     */
    public function terminarExpedienteAction($idExpediente  , $ruta = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $em->getRepository('AppBundle:Expedientes')->finalizarExpediente($expediente , $user);

        $metodo = $ruta.'Action';
        return $this->$metodo();
    }

    /**
     * @Route("/liberarExpediente/{idExpediente}/{ruta}", name="liberarExpediente")
     */
    public function liberarExpedienteAction($idExpediente  , $ruta = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
        $em->getRepository('AppBundle:Expedientes')->liberarExpediente($expediente , $user);

        $metodo = $ruta.'Action';
        return $this->$metodo();
    }










}
