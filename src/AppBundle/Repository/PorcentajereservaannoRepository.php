<?php

namespace AppBundle\Repository;
use DateTime;

/**
 * PorcentajereservaannoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PorcentajereservaannoRepository extends \Doctrine\ORM\EntityRepository
{
    public function modificarPorcientoReserva($porciento)
    {
        try{
            $em = $this->getEntityManager();
            $actual = new DateTime();
            $year = $actual->format('Y');
            $porcentaje  = $em->getRepository('AppBundle:Porcentajereservaannos')->findOneBy(array('anno' => $year));
            $porcentaje->setPorcentajereserva((float)$porciento);
            $em->persist($porcentaje);
            $em->flush();
            $msg = $porcentaje;

        }catch (\Exception $e){

            $msg = $e->getMessage();
        }
        return $msg;
    }
}
