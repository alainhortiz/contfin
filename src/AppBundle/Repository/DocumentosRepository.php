<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Documentos;
use AppBundle\Entity\Evidenciasexpedientes;
use DateTime;

/**
 * DocumentosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentosRepository extends \Doctrine\ORM\EntityRepository
{

    public function lastNombreReferencial()
    {

        $em = $this->getEntityManager();

        $dql = 'SELECT d.nombrereferencial
                FROM AppBundle:Documentos d
                WHERE d.id 
                = (SELECT MAX(d1.id)
                FROM AppBundle:Documentos d1)';

        $query = $em->createQuery($dql);

        /** @noinspection OneTimeUseVariablesInspection */
        $nombreReferencial = $query->getResult();

        $lastName = count($nombreReferencial) == 0 ? 0 : $nombreReferencial[0]['nombrereferencial'];

        return $lastName;

    }

    public function agregarDocumento($user, $nombreCompleto, $nombreReferencial)
    {
        $actual = new DateTime('now');
        $fechaSubida = $actual->format('Y-m-d');

        try{
            $em = $this->getEntityManager();
            $documento = new Documentos();
            $documento->setUsuario($user);
            $documento->setNombredocumento($nombreCompleto);
            $documento->setNombrereferencial($nombreReferencial);
            $documento->setFechasubida(new DateTime($fechaSubida));

            $em->persist($documento);
            $em->flush();
            $msg = $documento;

        }catch (\Exception $e){

            $msg = 'Se produjo un error al insertar el documento';
        }
        return $msg;
    }

    public function agregarEvidenciaDocumento($idDocumento,$idExpediente)
    {

        try{
            $em = $this->getEntityManager();
            $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
            $documento = $em->getRepository('AppBundle:Documentos')->find($idDocumento);
            $evidenciaDocumento = new Evidenciasexpedientes();
            $evidenciaDocumento->setExpediente($expediente);
            $evidenciaDocumento->setDocumento($documento);

            $em->persist($evidenciaDocumento);
            $em->flush();
            $msg = $evidenciaDocumento;

        }catch (\Exception $e){

            $msg = 'Se produjo un error al insertar el adunto del expediente';
        }
        return $msg;
    }


    public function eliminarEvidenciaDocumento($idDocumento,$idExpediente)
    {
        try {
            $em = $this->getEntityManager();
            $expediente = $em->getRepository('AppBundle:Expedientes')->find($idExpediente);
            $documento = $em->getRepository('AppBundle:Documentos')->find($idDocumento);
            $evidenciaDocumento = $em->getRepository('AppBundle:Evidenciasexpedientes')->findOneBy(array('expediente' => $expediente , 'documento' => $documento));

            $em->remove($evidenciaDocumento);
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e){

            $msg = 'Se produjo un error al borrar el adjunto del expediente';
        }
        return $msg;
    }

    public function eliminarDocumento($idDocumento)
    {
        try {
            $em = $this->getEntityManager();
            $documento = $em->getRepository('AppBundle:Documentos')->find($idDocumento);

            $em->remove($documento);
            $em->flush();
            $msg = 'ok';

        }catch (\Exception $e){

            $msg = 'Se produjo un error al borrar el documento adjunto';
        }
        return $msg;
    }
}
