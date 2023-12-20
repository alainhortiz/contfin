<?php

namespace AppBundle\Repository;

/**
 * NumeroseconomicosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NumeroseconomicosRepository extends \Doctrine\ORM\EntityRepository
{
    public function listarNumerosEconomicos()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT ne FROM AppBundle:Numeroseconomicos ne
                WHERE  EXISTS (SELECT p FROM AppBundle:Presupuestosservicios p WHERE p.presupuestounitario - p.valordisponible > 0 AND p MEMBER OF ne.presupuestos )';
        $query = $em->createQuery($dql);
        $numerosEconomicos = $query->getResult();
        return $numerosEconomicos;
    }
}
