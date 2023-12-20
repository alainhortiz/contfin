<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrazaController extends Controller
{
    /**
     * @Route("/trazas", name="trazas")
     */
    public function mostrarTrazasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMoneda = $em->getRepository('AppBundle:Configuracionesgenerales')->tipoMoneda();
        $totalInicial = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoInicial();
        $totalGastado = $em->getRepository('AppBundle:Presupuestosservicios')->presupuestoGastado();
        $cantidadPartidasFondos = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasFondos();
        $cantidadPartidasSinUso = $em->getRepository('AppBundle:Presupuestosservicios')->cantidadPartidasSinUsos();

        $trazas = $em->getRepository('AppBundle:Traza')->findAll();

        return $this->render('Nomencladores/Trazas.html.twig' , array(
            'tipoMoneda' => $tipoMoneda,
            'totalInicial' => $totalInicial,
            'totalGastado' => $totalGastado,
            'cantidadPartidasFondos' => $cantidadPartidasFondos,
            'cantidadPartidasSinUso' => $cantidadPartidasSinUso,
            'trazas' => $trazas
        ));
    }

    /**
     * @Route("/insertTraza", name="insertTraza")
     */
    public function  insertTrazaAction($operacion , $descripcion)
    {
        $user = $this->getUser();

        $dataTraza = array(

            'username' => $user->getUsername(),
            'nombre' => $user->getPersona()->getNombre(),
            'operacion' => $operacion,
            'descripcion' => $descripcion
        );
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Traza')-> guardarTraza($dataTraza);
    }

}
