<?php

namespace AppBundle\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;

/**
 * PresupuestosserviciosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PresupuestosserviciosRepository extends \Doctrine\ORM\EntityRepository
{

    public function presupuestoInicial()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.presupuesto) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1
                AND p.presupuesto <> :p2
                AND p.inactivo = :p3';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , false);

        $total = $query->getResult();

        return $total[0][1];

    }

    public function presupuestoGastado()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.valorejecutado) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1
                AND p.presupuesto <> :p2
                AND p.inactivo = :p3';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' ,0);
        $query->setParameter('p3' ,false);

        $total = $query->getResult();

        return $total[0][1];
    }

    public function cantidadPartidasFondos()
    {
        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT COUNT(p) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible > :p3
                AND p.inactivo = :p4';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);

        $cantidad = $query->getResult();

        return $cantidad[0][1];

    }

    public function cantidadPartidasSinUsos()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT COUNT(p) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible =:p3
                AND p.inactivo = :p4';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);

        $cantidad = $query->getResult();

        return $cantidad[0][1];

    }

    public function partidasFondos()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT s.nombreseccion, 
                serv.nombreservicio, 
                n.codigonumeroeconomico, 
                (p.presupuesto - (p.valordisponible)/1000) as disponiblidad 
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.servicio serv 
                JOIN serv.seccion s
                JOIN p.numeroeconomico n 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible > :p3
                AND p.inactivo = :p4 
                ORDER BY s.nombreseccion, serv.nombreservicio, n.codigonumeroeconomico';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);

        /** @noinspection OneTimeUseVariablesInspection */
        $partidasFondos = $query->getResult();

        return $partidasFondos;

    }

    public function partidasSinUsos()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT s.nombreseccion, 
                serv.nombreservicio, 
                n.codigonumeroeconomico, 
                (p.presupuesto - (p.valordisponible)/1000) as disponiblidad
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.servicio serv 
                JOIN serv.seccion s
                JOIN p.numeroeconomico n 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible =:p3
                AND p.inactivo = :p4 
                ORDER BY s.nombreseccion, serv.nombreservicio, n.codigonumeroeconomico';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);

        /** @noinspection OneTimeUseVariablesInspection */
        $partidasSinFondos = $query->getResult();

        return $partidasSinFondos;

    }

    public function graficoSeccionesPresupuestos()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT s.id,s.nombreseccion as seccion,
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as disponiblidad,
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as liquidez  
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.servicio serv 
                JOIN serv.seccion s 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2 
                AND p.inactivo = :p3
                GROUP BY s.id,s.nombreseccion
                ORDER BY s.id';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , false);

        /** @noinspection OneTimeUseVariablesInspection */
        $presupuestoSecciones = $query->getResult();

        return $presupuestoSecciones;

    }

    public function graficoSeccionServiciosPresupuestos($seccion)
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT serv.nombreservicio as servicio,
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as disponiblidad,
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as liquidez  
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.servicio serv 
                JOIN serv.seccion s 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2 
                AND s.nombreseccion= :p3 
                AND p.inactivo = :p4 
                GROUP BY serv.nombreservicio
                ORDER BY serv.nombreservicio';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , $seccion);
        $query->setParameter('p4' , false);

        /** @noinspection OneTimeUseVariablesInspection */
        $presupuestoServicios = $query->getResult();


        return $presupuestoServicios;

    }

    public function presupuestoServicioGastado($servicio)
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as disponiblidad,
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as liquidez
                FROM AppBundle:Presupuestosservicios p 
                LEFT JOIN p.servicio s
                WHERE p.anno = :p1
                AND p.inactivo = :p2
                AND s.nombreservicio = :p3 ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);
        $query->setParameter('p3' , $servicio);

        /** @noinspection OneTimeUseVariablesInspection */
        $total = $query->getResult();

        return $total;

    }

    public function presupuestoEjecutado()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.valorejecutado) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1
                AND p.inactivo = :p2';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);

        $total = $query->getResult();

        $totalMiles = $total[0][1];

        if ($totalMiles ===null){
            $totalMiles =0;
        }
        return $totalMiles / 1000;

    }

    public function presupuestoDisponible()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.valordisponible) 
                FROM AppBundle:Presupuestosservicios p 
                WHERE p.anno = :p1
                AND p.inactivo = :p2';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);

        $total = $query->getResult();

        $totalMiles = $total[0][1];

        if ($totalMiles ===null){
            $totalMiles =0;
        }
        return $totalMiles / 1000;

    }

    //mis funciones
    public function presupuestosServiciosConFondo()
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');
        $dql = 'SELECT p FROM AppBundle:Presupuestosservicios p
                WHERE  p.presupuesto != 0 AND p.anno = :p1';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $presupuestos = $query->getResult();
        return $presupuestos;
    }

    //funciones para desagregar el presupuesto inicio
    public function presupuestoTotalPorSeccion()
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT s.id AS idSeccion, s.codigoseccion, s.nombreseccion, s.confidencial AS Confidencial, 
                SUM(p.presupuesto) AS Presupuesto , 
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as Liquidez, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad,
                (sum(p.valorejecutado)/1000) as Compromiso
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio ser JOIN ser.seccion s
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                GROUP BY s.id 
                ORDER BY s.id';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $total = $query->getResult();

        return $total;
    }

    public function listarServiciosSeccion($idSeccion)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  serv.id AS idServicio ,serv.codigoservicio,serv.nombreservicio, 
                SUM(p.presupuesto) AS Presupuesto  , 
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as Liquidez, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN serv.seccion s 
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                AND s.id = :p3 
                GROUP BY serv.id
                ORDER BY serv.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idSeccion);
        $total = $query->getResult();
        return $total;
    }

    public function listarNEServicio($idServicio)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  ne.codigonumeroeconomico, ne.nombrenumeroeconomico, 
                p.presupuesto AS Presupuesto  , 
                (p.presupuesto - (p.valorejecutado/1000)) as Liquidez, 
                (p.presupuesto - (p.valordisponible/1000)) as Disponibilidad
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN p.numeroeconomico ne 
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                AND serv.id = :p3 
                ORDER BY p.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idServicio);
        $total = $query->getResult();
        return $total;
    }

    public function presupuestosNeSeccion($idSeccion)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  ne.id AS idNumeroEconomico ,ne.codigonumeroeconomico, ne.nombrenumeroeconomico, 
                SUM(p.presupuesto) AS Presupuesto  , 
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as Liquidez, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN serv.seccion s JOIN p.numeroeconomico ne 
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                AND  s.id = :p3 
                GROUP BY ne.id
                ORDER BY ne.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idSeccion);
        $total = $query->getResult();
        return $total;
    }

    public function disponibilidadLeyPresupuesto($idSeccion)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  ne.id AS idNumeroEconomico ,ne.codigonumeroeconomico ,serv.id AS idServicio , serv.codigoservicio, 
                (p.presupuesto - (p.valordisponible/1000)) as Disponibilidad
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN serv.seccion s JOIN p.numeroeconomico ne 
                WHERE p.anno = :p1 
                AND  s.id = :p3 
                ORDER BY ne.id, serv.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idSeccion);
        $total = $query->getResult();
        return $total;
    }

    public function disponibilidadLeyPresupuestoTotalV($idSeccion)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  serv.id AS idServicio , serv.codigoservicio, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN serv.seccion s JOIN p.numeroeconomico ne 
                WHERE p.anno = :p1 
                AND  s.id = :p3 
                GROUP BY serv.id
                ORDER BY serv.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idSeccion);
        $total = $query->getResult();
        return $total;
    }

    public function totalPresupuestoServiciosSeccion($idSeccion)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  SUM(p.presupuesto) AS Presupuesto  , 
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as Liquidez, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad,
                (sum(p.valorejecutado)/1000) as Compromiso
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN serv.seccion s 
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                AND  s.id = :p3 ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idSeccion);
        $total = $query->getResult();
        return $total[0];
    }

    public function totalPresupuestoNEServicio($idServicio)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.presupuesto) AS Presupuesto  , 
                (sum(p.presupuesto) - (sum(p.valorejecutado))/1000) as Liquidez, 
                (sum(p.presupuesto) - (sum(p.valordisponible))/1000) as Disponibilidad,
                (sum(p.valorejecutado)/1000) as Compromiso
                FROM AppBundle:Presupuestosservicios p JOIN p.servicio serv  JOIN p.numeroeconomico ne 
                WHERE p.anno = :p1 
                AND  p.inactivo = false
                AND  p.presupuesto <> 0
                AND  serv.id = :p3 ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p3' , $idServicio);
        $total = $query->getResult();
        return $total[0];
    }

    public function listarProyectosServicio($idServicio)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT  pro.codigoproyecto, pro.nombreproyecto, 
                pro.presupuesto AS Presupuesto  , 
                (pro.presupuesto - (pro.valorejecutado/1000)) as Liquidez, 
                (pro.presupuesto - (pro.valordisponible/1000)) as Disponibilidad
                FROM AppBundle:Presupuestosproyectos pro JOIN pro.presupuestoservicio p JOIN p.servicio serv  JOIN p.numeroeconomico ne 
                WHERE pro.anno = :p1 
                AND  p.inactivo = false
                AND  pro.presupuesto <> 0
                AND  serv.id = :p3 
                AND  ne.codigonumeroeconomico = :p2 
                ORDER BY pro.id ';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , '2660');
        $query->setParameter('p3' , $idServicio);
        $total = $query->getResult();
        return $total;
    }

    public function totalPresupuestoProyectosServicio($idServicio)
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(pro.presupuesto) AS Presupuesto  , 
                (sum(pro.presupuesto) - (sum(pro.valorejecutado))/1000) as Liquidez, 
                (sum(pro.presupuesto) - (sum(pro.valordisponible))/1000) as Disponibilidad,
                (sum(pro.valorejecutado)/1000) as Compromiso
                FROM AppBundle:Presupuestosproyectos pro JOIN pro.presupuestoservicio p JOIN p.servicio serv  JOIN p.numeroeconomico ne 
                WHERE pro.anno = :p1 
                AND  p.inactivo = false
                AND  pro.presupuesto <> 0
                AND  serv.id = :p3 
                AND  ne.codigonumeroeconomico = :p2';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , '2660');
        $query->setParameter('p3' , $idServicio);
        $total = $query->getResult();
        return $total[0];
    }

    //funciones para desagregar el presupuesto fin

    public function aumentarValorDisponiblePartidas($partidas)
    {
        try{
            $em = $this->getEntityManager();
            $actual = new \DateTime();
            $year = $actual->format('Y');

            foreach ($partidas as $partida)
            {
                if($partida != '')
                {
                    $servicio = $em->getRepository('AppBundle:Servicios')->find($partida['servicio']);
                    $numeroEconomico = $em->getRepository('AppBundle:Numeroseconomicos')->find($partida['numeroEconomico']);
                    $presupuesServicio = $em->getRepository('AppBundle:Presupuestosservicios')->findOneBy(array('servicio' => $servicio , 'numeroeconomico' => $numeroEconomico, 'anno' => $year));
                    $presupuesServicio->setValordisponible((float)$presupuesServicio->getValordisponible() + (float)$partida['monto']);

                    $em->persist($presupuesServicio);
                }

            }
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e){

            $msg = 'Se produjo un error al aumentar el valor disponible';
        }
        return $msg;
    }

    public function disminuirValorDisponiblePartidas($partidas)
    {
        try{
            $em = $this->getEntityManager();
            $actual = new \DateTime();
            $year = $actual->format('Y');
            foreach ($partidas as $partida)
            {
                if($partida != '')
                {
                    $servicio = $em->getRepository('AppBundle:Servicios')->find($partida['servicio']);
                    $numeroEconomico = $em->getRepository('AppBundle:Numeroseconomicos')->find($partida['numeroEconomico']);
                    $presupuesServicio = $em->getRepository('AppBundle:Presupuestosservicios')->findOneBy(array('servicio' => $servicio , 'numeroeconomico' => $numeroEconomico, 'anno' => $year));
                    $presupuesServicio->setValordisponible((float)$presupuesServicio->getValordisponible() - (float)$partida['monto']);

                    $em->persist($presupuesServicio);
                }
            }
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e){

            $msg = 'Se produjo un error al diminuir el valor disponible';
        }
        return $msg;
    }

    public function aumentarValorEjecutadoPartidas($partidas)
    {
        try{
            $em = $this->getEntityManager();
            $actual = new \DateTime();
            $year = $actual->format('Y');

            foreach ($partidas as $partida)
            {
                if($partida != '')
                {
                    $servicio = $em->getRepository('AppBundle:Servicios')->find($partida['servicio']);
                    $numeroEconomico = $em->getRepository('AppBundle:Numeroseconomicos')->find($partida['numeroEconomico']);
                    $presupuesServicio = $em->getRepository('AppBundle:Presupuestosservicios')->findOneBy(array('servicio' => $servicio , 'numeroeconomico' => $numeroEconomico, 'anno' => $year));
                    $presupuesServicio->setValorejecutado((float)$presupuesServicio->getValorejecutado() + (float)$partida['monto']);

                    $em->persist($presupuesServicio);
                }
            }
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e){

            $msg = 'Se produjo un error al aumentar el valor disponible';
        }
        return $msg;
    }

    //funciones para ajustar el presupuesto del capitulo II

    public function presupuestoInicialCapituloII()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.presupuesto) 
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.numeroeconomico ne
                JOIN ne.capitulo c
                WHERE p.anno = :p1
                AND p.presupuesto <> :p2
                AND p.inactivo = :p3
                AND c.codigocapitulo = :p4';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , false);
        $query->setParameter('p4' , 'II');

        $total = $query->getResult();

        return $total[0][1];

    }

    public function presupuestoEjecutadoCapituloII()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.valorejecutado) 
                FROM AppBundle:Presupuestosservicios p
                JOIN p.numeroeconomico ne
                JOIN ne.capitulo c 
                WHERE p.anno = :p1
                AND p.inactivo = :p2
                AND c.codigocapitulo = :p3';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);
        $query->setParameter('p3' , 'II');

        $total = $query->getResult();

        $totalMiles = $total[0][1];

        if ($totalMiles ===null){
            $totalMiles =0;
        }
        return $totalMiles / 1000;

    }

    public function presupuestoDisponibleCapituloII()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT SUM(p.valordisponible) 
                FROM AppBundle:Presupuestosservicios p
                JOIN p.numeroeconomico ne
                JOIN ne.capitulo c 
                WHERE p.anno = :p1
                AND p.inactivo = :p2
                AND c.codigocapitulo = :p3';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);
        $query->setParameter('p3' , 'II');

        $total = $query->getResult();

        $totalMiles = $total[0][1];

        if ($totalMiles ===null){
            $totalMiles =0;
        }
        return $totalMiles / 1000;

    }

    public function cantidadPartidasFondosCapituloII()
    {
        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT COUNT(p) 
                FROM AppBundle:Presupuestosservicios p
                JOIN p.numeroeconomico ne
                JOIN ne.capitulo c 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible > :p3
                AND p.inactivo = :p4
                AND c.codigocapitulo = :p5';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);
        $query->setParameter('p5' , 'II');

        $cantidad = $query->getResult();

        return $cantidad[0][1];

    }

    public function cantidadPartidasSinUsosCapituloII()
    {

        $em = $this->getEntityManager();

        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT COUNT(p) 
                FROM AppBundle:Presupuestosservicios p
                JOIN p.numeroeconomico ne
                JOIN ne.capitulo c 
                WHERE p.anno = :p1 
                AND p.presupuesto <> :p2
                AND p.valordisponible =:p3
                AND p.inactivo = :p4
                AND c.codigocapitulo = :p5';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , 0);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , false);
        $query->setParameter('p5' , 'II');

        $cantidad = $query->getResult();

        return $cantidad[0][1];

    }

    public function presupuestoPartidasCapituloII()
    {
        $em = $this->getEntityManager();
        $actual = new DateTime();
        $year = $actual->format('Y');

        $dql = 'SELECT p.id,s.nombreseccion, 
                serv.nombreservicio, 
                ne.codigonumeroeconomico AS NE, 
                p.presupuesto AS Presupuesto, 
                (p.presupuestounitario - p.valorejecutado)/1000 as Liquidez, 
                (p.presupuestounitario - p.valordisponible)/1000 as Disponibilidad,
                (p.valorejecutado)/1000 as Compromiso
                FROM AppBundle:Presupuestosservicios p 
                JOIN p.servicio serv 
                JOIN serv.seccion s
                JOIN p.numeroeconomico ne 
                JOIN ne.capitulo c 
                WHERE p.anno = :p1 
                AND p.inactivo = :p2
                AND p.presupuesto <> :p3
                AND c.codigocapitulo = :p4
                GROUP BY p.id,s.nombreseccion, serv.nombreservicio,ne.codigonumeroeconomico
                ORDER BY s.nombreseccion, serv.nombreservicio, ne.codigonumeroeconomico';

        $query = $em->createQuery($dql);
        $query->setParameter('p1' , $year);
        $query->setParameter('p2' , false);
        $query->setParameter('p3' , 0);
        $query->setParameter('p4' , 'II');
        $total = $query->getResult();

        return $total;
    }

    public function cambiarPresupuesto($data){
        try {
            $em = $this->getEntityManager();
            $presupuestoAnterior = $em->getRepository('AppBundle:Presupuestosservicios')->find($data['idPresupuestoAnterior']);
            $presupuestoNuevo = $em->getRepository('AppBundle:Presupuestosservicios')->find($data['idPresupuestoNuevo']);
            $presupuestoAnterior ->setPresupuesto($presupuestoAnterior->getPresupuesto() - $data['monto']);
            $presupuestoAnterior ->setPresupuestoreal($presupuestoAnterior->getPresupuestoreal() - $data['monto']);
            $presupuestoAnterior ->setPresupuestounitario($presupuestoAnterior->getPresupuestounitario() - ($data['monto'] * 1000));
            $presupuestoNuevo ->setPresupuesto($presupuestoNuevo->getPresupuesto() + $data['monto']);
            $presupuestoNuevo ->setPresupuestoreal($presupuestoNuevo->getPresupuestoreal() + $data['monto']);
            $presupuestoNuevo ->setPresupuestounitario($presupuestoNuevo->getPresupuestounitario() - ($data['monto'] * 1000));

            $em->persist($presupuestoAnterior);
            $em->persist($presupuestoNuevo);
            $em->flush();
            $msg = 'ok';

        } catch (Exception $e) {
            $msg = 'Se produjo un error al modificar el presupuesto';
        }

        return $msg;
    }



}
