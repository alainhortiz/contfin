<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Traza;

/**
 * TrazaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrazaRepository extends \Doctrine\ORM\EntityRepository
{
    public function guardarTraza($dataTraza)
    {
        try{
            $fecha = new \DateTime('now');

            $em = $this->getEntityManager();
            $traza = new Traza();
            $traza->setFecha($fecha);
            $traza->setUsername($dataTraza['username']);
            $traza->setNombre($dataTraza['nombre']);
            $traza->setOperacion($dataTraza['operacion']);
            $traza->setDescripcion($dataTraza['descripcion']);

            $em->persist($traza);
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e)
        {
            $msg = 'Se produjo un error al insertar la traza';
        }
        return $msg;
    }

    public function getLastTraza()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT t.fecha
                FROM AppBundle:Traza t
                WHERE t.id 
                = (SELECT MAX(t1.id)
                FROM AppBundle:Traza t1)';
        $query = $em->createQuery($dql);
        $trazas = $query->getResult();
        if(count($trazas) > 0) return $trazas[0];
        else return 0;
    }

}