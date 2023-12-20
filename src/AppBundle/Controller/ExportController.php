<?php

namespace AppBundle\Controller;

use AppBundle\ExportacionExcel\ExportadorExcel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Filesystem\Filesystem;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ExportController extends Controller
{
    /**
     * @Route("/exportarListadoExpedientes", name="exportarListadoExpedientes")
     */
    public function exportarListadoExpedientesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientes();

        $titulo = "LISTADO GENERAL DE EXPEDIENTES";
        $subtitulo = "Expedientes";
        $encabezados = array(

            'Fecha' => $date,
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesPorSupervisar", name="exportarListadoExpedientesPorSupervisar")
     */
    public function exportarListadoExpedientesPorSupervisarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesPorSupervisar($user);

        $titulo = "LISTADO DE EXPEDIENTES EN PROCESO";
        $subtitulo = "Expedientes por Supervisar";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesPorProcesar", name="exportarListadoExpedientesPorProcesar")
     */
    public function exportarListadoExpedientesPorProcesarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesPorProcesar($user);

        $titulo = "LISTADO DE EXPEDIENTES POR PROCESAR";
        $subtitulo = "Expedientes por Procesar";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesEnProceso", name="exportarListadoExpedientesEnProceso")
     */
    public function exportarListadoExpedientesEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesEnProceso($user);

        $titulo = "LISTADO DE EXPEDIENTES EN PROCESO";
        $subtitulo = "Expedientes En Proceso";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesDesestimados", name="exportarListadoExpedientesDesestimados")
     */
    public function exportarListadoExpedientesDesestimadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesDesestimados($user);

        $titulo = "LISTADO DE EXPEDIENTES DESESTIMADOS";
        $subtitulo = "Expedientes Desestimados";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesPorInstancia/{idInstancia}", name="exportarListadoExpedientesPorInstancia")
     */
    public function exportarListadoExpedientesPorInstanciaAction($idInstancia)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesPorInstancia($idInstancia);
        $instancia = $em->getRepository('AppBundle:Instancias')->find($idInstancia);

        $titulo = "LISTADO DE EXPEDIENTES POR INSTANCIA";
        $subtitulo = "Expedientes por instancia";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $instancia->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarListadoExpedientesSincredito", name="exportarListadoExpedientesSincredito")
     */
    public function exportarListadoExpedientesSincreditoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportListadoExpedientesSinCredito($user);

        $titulo = "LISTADO DE EXPEDIENTES SIN CREDITO";
        $subtitulo = "Expedientes sin crédito";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarPresupuestoPorSecciones", name="exportarPresupuestoPorSecciones")
     */
    public function exportarPresupuestoPorSeccionesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoTotalPorSeccion();

        $titulo = "PRESUPUESTO POR SECCIONES";
        $subtitulo = "Presupuesto por Secciones";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres);
    }

    /**
     * @Route("/exportarPresupuestoSeccion/{idSeccion}", name="exportarPresupuestoSeccion")
     */
    public function exportarPresupuestoSeccionAction($idSeccion)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $seccion = $em->getRepository('AppBundle:Secciones')->find($idSeccion);
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->listarServiciosSeccion($idSeccion);

        $titulo = "PRESUPUESTO POR SERVICIOS DE LA SECCION: ".$seccion->getCodigoseccion()." - ".$seccion->getNombreseccion();
        $subtitulo = "Presupuesto Sección ".$seccion->getCodigoseccion();
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres);
    }

    /**
     * @Route("/exportarPresupuestoServicio/{idServicio}", name="exportarPresupuestoServicio")
     */
    public function exportarPresupuestoServicioAction($idServicio)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $servicio = $em->getRepository('AppBundle:Servicios')->find($idServicio);
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->listarNEServicio($idServicio);

        $titulo = "PRESUPUESTO POR NE DEL SERVICIO: ".$servicio->getCodigoservicio()." DE LA SECCION: ".$servicio->getSeccion()->getCodigoseccion();
        $subtitulo = "Presupuesto Servicio ".$servicio->getCodigoservicio();
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres);
    }

    /**
     * @Route("/exportarMandamientosPagosEnProceso", name="exportarMandamientosPagosEnProceso")
     */
    public function exportarMandamientosPagosEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarMandamientosPagosEnProceso($user);

        $titulo = "MANDAMIENTOS DE PAGO EN PROCESO";
        $subtitulo = "Mandamientos de pago";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosMandamientosPagos($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarMandamientosPagosProcesados", name="exportarMandamientosPagosProcesados")
     */
    public function exportarMandamientosPagosProcesadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarMandamientosPagosProcesados($user);

        $titulo = "MANDAMIENTOS DE PAGO PROCESADOS";
        $subtitulo = "Mandamientos de pago";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosMandamientosPagos($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarPagosDirectosEnProceso", name="exportarPagosDirectosEnProceso")
     */
    public function exportarPagosDirectosEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarPagosDirectosEnProceso($user);

        $titulo = "PAGOS ANTICIPADOS EN PROCESO";
        $subtitulo = "Pagos anticipados";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosMandamientosPagos($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarPagosDirectosProcesados", name="exportarPagosDirectosProcesados")
     */
    public function exportarPagosDirectosProcesadosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $expedientes = $em->getRepository('AppBundle:Mandamientospagosexpedientes')->listarPagosDirectosProcesados($user);

        $titulo = "PAGOS ANTICIPADOS PROCESADOS";
        $subtitulo = "Pagos anticipados";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosMandamientosPagos($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarBuscadorExpediente/{data}", name="exportarBuscadorExpediente")
     */
    public function exportarBuscadorExpedienteAction($data)
    {
        $em = $this->getDoctrine()->getManager();
        $datos = json_decode($data);
        $campos = array(
            'fechaInicial' => $datos->fechaInicial,
            'fechaFinal' => $datos->fechaFinal,
            'operacion' => $datos->operacion,
            'numeroExpediente' => $datos->numeroExpediente,
            'numeroEconomico' => $datos->numeroEconomico,
            'importeSolicitado' => $datos->importeSolicitado,
            'beneficiario' => $datos->beneficiario,
            'seccion' => $datos->seccion,
            'servicio' => $datos->servicio,
            'estadoExpediente' => $datos->estadoExpediente,
        );

        $expedientes = $em->getRepository('AppBundle:Expedientes')->datosExportBuscadorExpedientes($campos);

        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');

        $titulo = "RESULTADOS DE LA BUSQUEDA";
        $subtitulo = "Expedientes";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosListados($titulo, $subtitulo , $encabezados ,$expedientes ,$nombres);
    }

    /**
     * @Route("/exportarDisponibilidadLeyDePresupuesto/{idSeccion}", name="exportarDisponibilidadLeyDePresupuesto")
     */
    public function exportarDisponibilidadLeyDePresupuestoAction($idSeccion)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $seccion = $em->getRepository('AppBundle:Secciones')->find($idSeccion);
        $servicios = $em->getRepository('AppBundle:Servicios')->listarServiciosSeccion($idSeccion);
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->disponibilidadLeyPresupuesto($idSeccion);
        $presupuestosTotalV = $em->getRepository('AppBundle:Presupuestosservicios')->disponibilidadLeyPresupuestoTotalV($idSeccion);

        $titulo = "DISPONIBILIDAD DE LA SECCION: ".$seccion->getCodigoseccion()." - ".$seccion->getNombreseccion();
        $subtitulo = "Disponibilidad Sección ".$seccion->getCodigoseccion();
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarLeyPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres , $servicios , $presupuestosTotalV);
    }

    /**
     * @Route("/exportarPartidasCapituloII", name="exportarPartidasCapituloII")
     */
    public function exportarPartidasCapituloIIAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $actual = new \DateTime('now');
        $date = $actual->format('Y-m-d');
        $presupuestos = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoPartidasCapituloII();

        $titulo = "PARTIDAS PRESUPUESTARIAS DEL CAPITULO II";
        $subtitulo = "Presupuesto capitulo II";
        $encabezados = array(

            'Fecha' => $date,
            'Instancia'   => $user->getInstancia()->getNombreinstancia(),
        );
        $nombres = $user->getPersona()->getNombres().' '.$user->getPersona()->getApellido1().' '.$user->getPersona()->getApellido2();

        $excel = new ExportadorExcel();
        $excel->exportarDatosPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres);
    }

    /**
     * @Route("/exportarAprobadoPDFSystem", name="exportarAprobadoPDFSystem")
     */
    public function exportarAprobadoPDFSystemAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $idExpediente = $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();

        $actual = new DateTime();
        $year = $actual->format('Y');
        $carpeta = strtolower($configuracionGeneral['caminorepositoriodocumento']);

        //Validar si configuracion general esta vacio
        if ($carpeta === '')  {
            $carpeta ='documentos';
        }

        $fs = new Filesystem();

        //Verificar si existe la carpeta
        $existe = $fs->exists($carpeta . '/' . $year);

        //Si no existe la carpeta se crea
        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }
        $destino = $carpeta . '/' .$year . '/';
        $adjuntoNombre = 'Carta a Primatura No. ' . $expediente->getNumeroExpedienteMostrar() . '.pdf';

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $historicos = $expediente->getHistoricosEstados();

        foreach ($historicos as $historico)
        {
            if ($historico->getEstado()->getInstancia()->getPreorden() == '4' && $historico->getEstado()->getEstadoexpediente()->getNombreestado() == 'APROBADO') {
                $actual = $historico->getFecha();
                $year = $actual->format('Y');
                $mes = $actual->format('F');
                $mes = $this->mesEspanol($mes);
                $dia = $actual->format('j');
            }
        }

        $fecha = $dia . ' de ' . $mes . ' de ' . $year;

        $parametrizaciones = $expediente->getParametrizaciones();
        $registros = $em->getRepository('AppBundle:Registrosexpedientes')->registrosCartas($expediente);

        $posRegistro = count($registros);

        if ($posRegistro > 1) {
            $entidadRegistro = $registros[1]->getMinisterio() ->getPrefijoministerio() . $registros[1]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[1]->getNumeroregistro();
            $fechaRegistro = $registros[1]->getFecharegistro();
        } else {
            $entidadRegistro = $registros[0]->getMinisterio() ->getPrefijoministerio() . $registros[0]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[0]->getNumeroregistro();
            $fechaRegistro = $registros[0]->getFecharegistro();
        }

        $yearRegistro = $fechaRegistro->format('Y');
        $mesRegistro = $fechaRegistro->format('F');
        $diaRegistro = $fechaRegistro->format('j');

        $mesRegistro = $this->mesEspanol($mesRegistro);

        $fechaLargaRegistro = $diaRegistro . ' de ' . $mesRegistro . ' de ' . $yearRegistro;

        $pos = count($parametrizaciones)-1;

        while ($pos != -1 and $parametrizaciones[$pos]->getInstancia()->getPreorden() !='3') {
            $pos--;
        }

        $dictamen = $expediente->getParametrizaciones()->last()->getObservacion();
        $monto = $expediente->getParametrizaciones()->last()->getMontoapagar();

        if ($pos != -1) {
            $dictamen = $parametrizaciones[$pos]->getObservacion();
            $monto = $parametrizaciones[$pos]->getMontoapagar();
        }

        $html = $this->renderView('Carta/cartaAprobadoPDF.html.twig', [
            'expediente'  => $expediente,
            'monto' => $monto,
            'dictamen' => $dictamen,
            'fecha'  => $fecha,
            'entidadRegistro'  => $entidadRegistro,
            'numeroRegistro'  => $numeroRegistro,
            'fechaLargaRegistro'  => $fechaLargaRegistro
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('letter', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/web/'. $destino;
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/' . $adjuntoNombre;

        try{
            // Write file to the desired path
            file_put_contents($pdfFilepath, $output);
            $msg = 'ok';

        }catch (\Exception $e){

            if(strpos($e->getMessage() , 'file_put_contents') > 0)
            {
                $msg = 'La carta aprobada no se pudo generar porque tiene el PDF abierto, por favor cierre el PDF.';
            }
            else
            {
                $msg = 'Se produjo un error al generar la carta aprobada';
            }

        }

        return new Response($msg);
    }

    /**
     * @Route("/exportarDesestimadoDirectorPDFSystem", name="exportarDesestimadoDirectorPDFSystem")
     */
    public function exportarDesestimadoDirectorPDFSystemAction()
    {
        $peticion = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $idExpediente = $peticion->request->get('idExpediente');
        $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();

        $actual = new DateTime();
        $year = $actual->format('Y');
        $carpeta = strtolower($configuracionGeneral['caminorepositoriodocumento']);

        //Validar si configuracion general esta vacio
        if ($carpeta === '')  {
            $carpeta ='documentos';
        }

        $fs = new Filesystem();

        //Verificar si existe la carpeta
        $existe = $fs->exists($carpeta . '/' . $year);

        //Si no existe la carpeta se crea
        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }
        $destino = $carpeta . '/' .$year . '/';
        $adjuntoNombre = 'Carta desestimado por Director No. ' . $expediente->getNumeroExpedienteMostrar() . '.pdf';

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $historicos = $expediente->getHistoricosEstados();

        foreach ($historicos as $historico)
        {
            if ($historico->getEstado()->getInstancia()->getPreorden() == '3' && $historico->getEstado()->getEstadoexpediente()->getNombreestado() == 'DESESTIMADO') {
                $actual = $historico->getFecha();
                $year = $actual->format('Y');
                $mes = $actual->format('F');
                $mes = $this->mesEspanol($mes);
                $dia = $actual->format('j');
            }
        }

        $fecha = $dia . ' de ' . $mes . ' de ' . $year;

        $parametrizaciones = $expediente->getParametrizaciones();
        $registros = $em->getRepository('AppBundle:Registrosexpedientes')->registrosCartas($expediente);

        $posRegistro = count($registros);

        if ($posRegistro > 1) {
            $entidadRegistro = $registros[1]->getMinisterio() ->getPrefijoministerio() . $registros[1]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[1]->getNumeroregistro();
            $fechaRegistro = $registros[1]->getFecharegistro();
        } else {
            $entidadRegistro = $registros[0]->getMinisterio() ->getPrefijoministerio() . $registros[0]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[0]->getNumeroregistro();
            $fechaRegistro = $registros[0]->getFecharegistro();
        }

        $yearRegistro = $fechaRegistro->format('Y');
        $mesRegistro = $fechaRegistro->format('F');
        $diaRegistro = $fechaRegistro->format('j');

        $mesRegistro = $this->mesEspanol($mesRegistro);

        $fechaLargaRegistro = $diaRegistro . ' de ' . $mesRegistro . ' de ' . $yearRegistro;

        $pos = count($parametrizaciones)-1;

        while ($pos != -1 and $parametrizaciones[$pos]->getInstancia()->getPreorden() !='3') {
            $pos--;
        }

        $dictamen = $expediente->getParametrizaciones()->last()->getObservacion();
        $monto = $expediente->getParametrizaciones()->last()->getMontoapagar();

        if ($pos != -1) {
            $dictamen = $parametrizaciones[$pos]->getObservacion();
            $monto = $parametrizaciones[$pos]->getMontoapagar();
        }

        $html = $this->renderView('Carta/cartaDesestimadoDirectorPDF.html.twig', [
            'expediente'  => $expediente,
            'monto' => $monto,
            'dictamen' => $dictamen,
            'fecha'  => $fecha,
            'entidadRegistro'  => $entidadRegistro,
            'numeroRegistro'  => $numeroRegistro,
            'fechaLargaRegistro'  => $fechaLargaRegistro
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('letter', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/web/'. $destino;
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/' . $adjuntoNombre;

        try{
            // Write file to the desired path
            file_put_contents($pdfFilepath, $output);
            $msg = 'ok';

        }catch (\Exception $e){

            if(strpos($e->getMessage() , 'file_put_contents') > 0)
            {
                $msg = 'La carta desestimada no se pudo generar porque tiene el PDF abierto, por favor cierre el PDF.';
            }
            else
            {
                $msg = 'Se produjo un error al generar la carta desestimada';
            }

        }

        return new Response($msg);
    }

    /**
     * @Route("/exportarAprobadoPDF", name="exportarAprobadoPDF")
     */
    public function exportarAprobadoPDFAction($expediente)
    {
        $em = $this->getDoctrine()->getManager();

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();
        $lastName = $em->getRepository('AppBundle:Documentos')->lastNombreReferencial();

        $actual = new DateTime();
        $year = $actual->format('Y');
        $mes = $actual->format('F');
        $dia = $actual->format('j');
        $carpeta = strtolower($configuracionGeneral['caminorepositoriodocumento']);
        $mascara = $configuracionGeneral['caracteresmascaradocumento'];
        $extension = $configuracionGeneral['extensiondocumento'];
        $user = $this->getUser();
        $val='';

        //Validar si configuracion general esta vacio
        if ($carpeta === '')  {
            $carpeta ='documentos';
        } elseif ($mascara==='') {
            $mascara = 10;
        } elseif ($extension==='') {
            $extension = 'cfin';
        }

        $fs = new Filesystem();

        //Verificar si existe la carpeta
        $existe = $fs->exists($carpeta . '/' . $year);

        //Si no existe la carpeta se crea
        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }
        $destino = $carpeta . '/' .$year . '/';
        $adjuntoNombre = 'Carta a Primatura No. ' . $expediente->getNumeroExpedienteMostrar() . '.pdf';

        //Nombre referencial del pdf
        if($lastName === 0) {
            $mascaraActual = str_pad($val,$mascara - 1, '0') . '1';
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }
        else {
            $proximoValor = (int)substr($lastName, 4, $mascara) + 1;
            $mascaraActual = str_pad($val,$mascara - strlen($proximoValor), '0') . $proximoValor;
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $mes = $this->mesEspanol($mes);

        $fecha = $dia . ' de ' . $mes . ' de ' . $year;

        $parametrizaciones = $expediente->getParametrizaciones();
        $registros = $em->getRepository('AppBundle:Registrosexpedientes')->registrosCartas($expediente);

        $posRegistro = count($registros);

        if ($posRegistro > 1) {
            $entidadRegistro = $registros[$posRegistro - 2]->getMinisterio() ->getPrefijoministerio() . $registros[$posRegistro - 2]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[$posRegistro - 2]->getNumeroregistro();
            $fechaRegistro = $registros[$posRegistro - 2]->getFecharegistro();
        } else {
            $entidadRegistro = $registros[0]->getMinisterio() ->getPrefijoministerio() . $registros[0]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[0]->getNumeroregistro();
            $fechaRegistro = $registros[0]->getFecharegistro();
        }

        $yearRegistro = $fechaRegistro->format('Y');
        $mesRegistro = $fechaRegistro->format('F');
        $diaRegistro = $fechaRegistro->format('j');

        $mesRegistro = $this->mesEspanol($mesRegistro);

        $fechaLargaRegistro = $diaRegistro . ' de ' . $mes . ' de ' . $yearRegistro;

        $pos = count($parametrizaciones)-1;

        while ($pos != -1 and $parametrizaciones[$pos]->getInstancia()->getPreorden() !='3') {
            $pos--;
        }

        $dictamen = $expediente->getParametrizaciones()->last()->getObservacion();
        $monto = $expediente->getParametrizaciones()->last()->getMontoapagar();

        if ($pos != -1) {
            $dictamen = $parametrizaciones[$pos]->getObservacion();
            $monto = $parametrizaciones[$pos]->getMontoapagar();
        }

        $html = $this->renderView('Carta/cartaAprobadoPDF.html.twig', [
            'expediente'  => $expediente,
            'monto' => $monto,
            'dictamen' => $dictamen,
            'fecha'  => $fecha,
            'entidadRegistro'  => $entidadRegistro,
            'numeroRegistro'  => $numeroRegistro,
            'fechaLargaRegistro'  => $fechaLargaRegistro
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('letter', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/web/'. $destino;
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/' . $adjuntoNombre;

        // Guardo en la tabla documento
        $documento  = $em->getRepository('AppBundle:Documentos')->agregarDocumento($user, $adjuntoNombre, $nombreReferencial);

        if (!is_string($documento)) {
            $idDocumento = $documento->getId();
            //Guardo en la tabla evidencia documento
            $evidenciaDocumento = $em->getRepository('AppBundle:Documentos')->agregarEvidenciaDocumento($idDocumento,$expediente->getId());
            if(!is_string($evidenciaDocumento)) {
                // Write file to the desired path
                file_put_contents($pdfFilepath, $output);
            }
        }

    }

    /**
     * @Route("/exportarDesestimadoDirector", name="exportarDesestimadoDirector")
     */
    public function exportarDesestimadoDirectorPDFAction($expediente)
    {
        $em = $this->getDoctrine()->getManager();

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();
        $lastName = $em->getRepository('AppBundle:Documentos')->lastNombreReferencial();

        $actual = new DateTime();
        $year = $actual->format('Y');
        $mes = $actual->format('F');
        $dia = $actual->format('j');
        $carpeta = strtolower($configuracionGeneral['caminorepositoriodocumento']);
        $mascara = $configuracionGeneral['caracteresmascaradocumento'];
        $extension = $configuracionGeneral['extensiondocumento'];
        $user = $this->getUser();
        $val='';

        //Validar si configuracion general esta vacio
        if ($carpeta === '')  {
            $carpeta ='documentos';
        } elseif ($mascara==='') {
            $mascara = 10;
        } elseif ($extension==='') {
            $extension = 'cfin';
        }

        $fs = new Filesystem();

        //Verificar si existe la carpeta
        $existe = $fs->exists($carpeta . '/' . $year);

        //Si no existe la carpeta se crea
        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }
        $destino = $carpeta . '/' .$year . '/';
        $adjuntoNombre = 'Carta desestimado por Director No. ' . $expediente->getNumeroExpedienteMostrar() . '.pdf';

        //Nombre referencial del pdf
        if($lastName === 0) {
            $mascaraActual = str_pad($val,$mascara - 1, '0') . '1';
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }
        else {
            $proximoValor = (int)substr($lastName, 4, $mascara) + 1;
            $mascaraActual = str_pad($val,$mascara - strlen($proximoValor), '0') . $proximoValor;
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $mes = $this->mesEspanol($mes);

        $fecha = $dia . ' de ' . $mes . ' de ' . $year;

        $parametrizaciones = $expediente->getParametrizaciones();

        $registros = $em->getRepository('AppBundle:Registrosexpedientes')->registrosCartas($expediente);

        $posRegistro = count($registros);

        if ($posRegistro > 1) {
            $entidadRegistro = $registros[$posRegistro - 2]->getMinisterio() ->getPrefijoministerio() . $registros[$posRegistro - 2]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[$posRegistro - 2]->getNumeroregistro();
            $fechaRegistro = $registros[$posRegistro - 2]->getFecharegistro();
        } else {
            $entidadRegistro = $registros[0]->getMinisterio() ->getPrefijoministerio() . $registros[0]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[0]->getNumeroregistro();
            $fechaRegistro = $registros[0]->getFecharegistro();
        }

        $yearRegistro = $fechaRegistro->format('Y');
        $mesRegistro = $fechaRegistro->format('F');
        $diaRegistro = $fechaRegistro->format('j');

        $mesRegistro = $this->mesEspanol($mesRegistro);

        $fechaLargaRegistro = $diaRegistro . ' de ' . $mes . ' de ' . $yearRegistro;

        $pos = count($parametrizaciones)-1;

        while ($pos != -1 and $parametrizaciones[$pos]->getInstancia()->getPreorden() !='3') {
            $pos--;
        }

        $dictamen = $expediente->getParametrizaciones()->last()->getObservacion();
        $monto = $expediente->getParametrizaciones()->last()->getMontoapagar();


        if ($pos != -1) {
            $dictamen = $parametrizaciones[$pos]->getObservacion();
            $monto = $parametrizaciones[$pos]->getMontoapagar();
        }

        $html = $this->renderView('Carta/cartaDesestimadoDirectorPDF.html.twig', [
            'expediente'  => $expediente,
            'monto' => $monto,
            'dictamen' => $dictamen,
            'fecha'  => $fecha,
            'entidadRegistro'  => $entidadRegistro,
            'numeroRegistro'  => $numeroRegistro,
            'fechaLargaRegistro'  => $fechaLargaRegistro
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('letter', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/web/'. $destino;
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/' . $adjuntoNombre;

        // Guardo en la tabla documento
        $documento  = $em->getRepository('AppBundle:Documentos')->agregarDocumento($user, $adjuntoNombre, $nombreReferencial);

        if (!is_string($documento)) {
            $idDocumento = $documento->getId();
            //Guardo en la tabla evidencia documento
            $evidenciaDocumento = $em->getRepository('AppBundle:Documentos')->agregarEvidenciaDocumento($idDocumento,$expediente->getId());
            if(!is_string($evidenciaDocumento)) {
                // Write file to the desired path
                file_put_contents($pdfFilepath, $output);
            }
        }

    }

    /**
     * @Route("/exportarDesestimadoMinistro", name="exportarDesestimadoMinistro")
     */
    public function exportarDesestimadoMinistroPDFAction($expediente)
    {
        $em = $this->getDoctrine()->getManager();

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();
        $lastName = $em->getRepository('AppBundle:Documentos')->lastNombreReferencial();

        $actual = new DateTime();
        $year = $actual->format('Y');
        $mes = $actual->format('F');
        $dia = $actual->format('j');
        $carpeta = strtolower($configuracionGeneral['caminorepositoriodocumento']);
        $mascara = $configuracionGeneral['caracteresmascaradocumento'];
        $extension = $configuracionGeneral['extensiondocumento'];
        $user = $this->getUser();
        $val='';

        //Validar si configuracion general esta vacio
        if ($carpeta === '')  {
            $carpeta ='documentos';
        } elseif ($mascara==='') {
            $mascara = 10;
        } elseif ($extension==='') {
            $extension = 'cfin';
        }

        $fs = new Filesystem();

        //Verificar si existe la carpeta
        $existe = $fs->exists($carpeta . '/' . $year);

        //Si no existe la carpeta se crea
        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }
        $destino = $carpeta . '/' .$year . '/';
        $adjuntoNombre = 'Carta desestimada por Ministro No. ' . $expediente->getNumeroExpedienteMostrar() . '.pdf';

        //Nombre referencial del pdf
        if($lastName === 0) {
            $mascaraActual = str_pad($val,$mascara - 1, '0') . '1';
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }
        else {
            $proximoValor = (int)substr($lastName, 4, $mascara) + 1;
            $mascaraActual = str_pad($val,$mascara - strlen($proximoValor), '0') . $proximoValor;
            $nombreReferencial = $year . $mascaraActual . '.' . $extension;
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $mes = $this->mesEspanol($mes);

        $fecha = $dia . ' de ' . $mes . ' de ' . $year;

        $parametrizaciones = $expediente->getParametrizaciones();

        $registros = $em->getRepository('AppBundle:Registrosexpedientes')->registrosCartas($expediente);

        $posRegistro = count($registros);

        if ($posRegistro > 1) {
            $entidadRegistro = $registros[$posRegistro - 2]->getMinisterio() ->getPrefijoministerio() . $registros[$posRegistro - 2]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[$posRegistro - 2]->getNumeroregistro();
            $fechaRegistro = $registros[$posRegistro - 2]->getFecharegistro();
        } else {
            $entidadRegistro = $registros[0]->getMinisterio() ->getPrefijoministerio() . $registros[0]->getMinisterio() ->getSeccion()-> getNombreseccion();
            $numeroRegistro = $registros[0]->getNumeroregistro();
            $fechaRegistro = $registros[0]->getFecharegistro();
        }

        $yearRegistro = $fechaRegistro->format('Y');
        $mesRegistro = $fechaRegistro->format('F');
        $diaRegistro = $fechaRegistro->format('j');

        $mesRegistro = $this->mesEspanol($mesRegistro);

        $fechaLargaRegistro = $diaRegistro . ' de ' . $mesRegistro . ' de ' . $yearRegistro;

        $pos = count($parametrizaciones)-1;

        while ($pos != -1 and $parametrizaciones[$pos]->getInstancia()->getPreorden() !='3') {
            $pos--;
        }

        $dictamen = $expediente->getParametrizaciones()->last()->getObservacion();
        $monto = $expediente->getParametrizaciones()->last()->getMontoapagar();


        if ($pos != -1) {
            $dictamen = $parametrizaciones[$pos]->getObservacion();
            $monto = $parametrizaciones[$pos]->getMontoapagar();
        }

        $html = $this->renderView('Carta/cartaDesestimadoMinistroPDF.html.twig', [
            'expediente'  => $expediente,
            'monto' => $monto,
            'dictamen' => $dictamen,
            'fecha'  => $fecha,
            'entidadRegistro'  => $entidadRegistro,
            'numeroRegistro'  => $numeroRegistro,
            'fechaLargaRegistro'  => $fechaLargaRegistro
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('letter', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/web/'. $destino;
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/' . $adjuntoNombre;

        // Guardo en la tabla documento
        $documento  = $em->getRepository('AppBundle:Documentos')->agregarDocumento($user, $adjuntoNombre, $nombreReferencial);

        if (!is_string($documento)) {
            $idDocumento = $documento->getId();
            //Guardo en la tabla evidencia documento
            $evidenciaDocumento = $em->getRepository('AppBundle:Documentos')->agregarEvidenciaDocumento($idDocumento,$expediente->getId());
            if(!is_string($evidenciaDocumento)) {
                // Write file to the desired path
                file_put_contents($pdfFilepath, $output);
            }
        }

    }

    private function mesEspanol($mesIngles)
    {
        $mes = '';
        if ($mesIngles ==='January') {
            $mes='Enero';
        } else if ($mesIngles ==='February') {
            $mes='Febrero';
        } else if ($mesIngles ==='March') {
            $mes='Marzo';
        } else if ($mesIngles ==='April') {
            $mes='Abril';
        } else if ($mesIngles ==='May') {
            $mes='Mayo';
        } else if ($mesIngles ==='June') {
            $mes='Junio';
        } else if ($mesIngles ==='July') {
            $mes='Julio';
        } else if ($mesIngles ==='August') {
            $mes='Agosto';
        } else if ($mesIngles ==='September') {
            $mes='Septiembre';
        } else if ($mesIngles ==='October') {
            $mes='Octubre';
        } else if ($mesIngles ==='November') {
            $mes='Noviembre';
        } else if ($mesIngles ==='December') {
            $mes='Diciembre';
        }

        return $mes;
    }

}
