<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Parametrizacionexpedientes;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ParametrizacionexpedientesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParametrizacionexpedientesRepository extends \Doctrine\ORM\EntityRepository
{
    public function parametrizarExpediente($data , $user)
    {
        try{
            $em = $this->getEntityManager();
            $expediente = $data['expediente'];
            $parametrizacion = $em->getRepository('AppBundle:Parametrizacionexpedientes')->findOneBy(array('expediente' => $expediente , 'instancia' =>  $user->getInstancia()));
            if(!$parametrizacion)
            {
                $parametrizacion  = new Parametrizacionexpedientes();
                $parametrizacion->setInstancia($user->getInstancia());
                $parametrizacion->setExpediente($expediente);
            }

            $parametrizacion->setMontoapagar($data['montoAPagar']);
            $parametrizacion->setObservacion($data['dictamen']);

            $parametrosInstancia = new ArrayCollection();

            if($data['parametros'])
            {
                foreach ($data['parametros'] as $parametroName)
                {
                    $parametro = $em->getRepository('AppBundle:Parametros')->findOneBy(array('nombreparametro' => $parametroName));
                    $parametrosInstancia[] = $em->getRepository('AppBundle:Parametrosinstancias')->findOneBy(array('parametro' => $parametro , 'instancia' => $user->getInstancia()));
                }
            }
            $parametrizacion->setParametrosInstancias($parametrosInstancia);
            $em->persist($parametrizacion);

            $data['prioritario'] == '0' ? $expediente->setPrioridad(false) : $expediente->setPrioridad(true);
            $em->persist($expediente);

            $em->flush();
            $msg = $parametrizacion;

        }catch (\Exception $e){

            $msg = 'Se produjo un error al parametrizar el expediente';

        }
        return $msg;
    }
}
