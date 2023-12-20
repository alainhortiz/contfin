<?php

namespace AppBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{

    /**
     * @Route("/adjuntoInsertar/{idExpediente}", name="adjuntoInsertar")
     */
    public function adjuntoInsertarAction($idExpediente)
    {

        $em = $this->getDoctrine()->getManager();

        $adjuntoNombre = $_FILES['fichero_usuario']['name'];
        //El nombre original del fichero en la máquina del cliente.

        $adjuntoTipo = $_FILES['fichero_usuario']['type'];
        //El tipo MIME del fichero, si el navegador proporcionó esta información. Un ejemplo sería "image/gif". Este tipo MIME, sin embargo,
        // no se comprueba en el lado de PHP y por lo tanto no se garantiza su valor.

        $adjuntoSize = $_FILES['fichero_usuario']['size'];
        //El tamaño, en bytes, del fichero subido.

        $adjuntoNombreTemporal = $_FILES['fichero_usuario']['tmp_name'];

        //El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();
        $lastName = $em->getRepository('AppBundle:Documentos')->lastNombreReferencial();

        $actual = new DateTime();
        $year = $actual->format('Y');
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

        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }

        $destino = $carpeta . '/' .$year . '/';

        $fichero_subido = $destino . $adjuntoNombre;

        if (move_uploaded_file($adjuntoNombreTemporal, $fichero_subido)) {
            if($lastName === 0) {
                $mascaraActual = str_pad($val,$mascara - 1, '0') . '1';
                $nombreReferencial = $year . $mascaraActual . '.' . $extension;
            }
            else {
                $proximoValor = (int)substr($lastName, 4, $mascara) + 1;
                $mascaraActual = str_pad($val,$mascara - strlen($proximoValor), '0') . $proximoValor;
                $nombreReferencial = $year . $mascaraActual . '.' . $extension;
            }
            // Guardo en la tabla documento
            $documento  = $em->getRepository('AppBundle:Documentos')->agregarDocumento($user, $adjuntoNombre, $nombreReferencial);
            if(is_string($documento)) {
                $arreglo = array('valido' => false,
                    'mensaje' => $documento);
            }
            else {
                $idDocumento = $documento->getId();
                //Guardo en la tabla evidencia documento
                $evidenciaDocumento = $em->getRepository('AppBundle:Documentos')->agregarEvidenciaDocumento($idDocumento,$idExpediente);
                if(is_string($evidenciaDocumento)) {
                    $arreglo = array('valido' => false,
                        'mensaje' => $documento);
                }
                else {
                    $vinculo = 'http://'.$_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . '/contfin/web/' . $destino . $adjuntoNombre;

                    $arreglo = array('valido' => true,
                        'nombreAdjunto' => $adjuntoNombre,
                        'vinculo' => $vinculo,
                        'idDocumento' => $idDocumento);
                }
            }
        } else {
            $arreglo = array('valido' => false,
                'mensaje' => '¡Este fichero no se pudo adjuntar!');;
        }

        $result = json_encode($arreglo);
        return new JsonResponse($result);
    }

    /**
     * @Route("/insertarDocumento", name="insertarDocumento")
     */
    public function insertarDocumentoAction()
    {

        $em = $this->getDoctrine()->getManager();

        $adjuntoNombre = $_FILES['fichero_usuario']['name'];
        //El nombre original del fichero en la máquina del cliente.

       /* $adjuntoTipo = $_FILES['fichero_usuario']['type'];*/
        //El tipo MIME del fichero, si el navegador proporcionó esta información. Un ejemplo sería "image/gif". Este tipo MIME, sin embargo,
        // no se comprueba en el lado de PHP y por lo tanto no se garantiza su valor.

       /* $adjuntoSize = $_FILES['fichero_usuario']['size'];*/
        //El tamaño, en bytes, del fichero subido.

        $adjuntoNombreTemporal = $_FILES['fichero_usuario']['tmp_name'];

        //El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.

        $configuracionGeneral = $em->getRepository('AppBundle:Configuracionesgenerales')->configuracionFicheros();
        $lastName = $em->getRepository('AppBundle:Documentos')->lastNombreReferencial();

        $actual = new DateTime();
        $year = $actual->format('Y');
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

        if (!$existe) {
            $fs->mkdir($carpeta . '/' . $year,0700);
        }

        $destino = $carpeta . '/' .$year . '/';

        $fichero_subido = $destino . $adjuntoNombre;

        if (move_uploaded_file($adjuntoNombreTemporal, $fichero_subido)) {
            if($lastName === 0) {
                $mascaraActual = str_pad($val,$mascara - 1, '0') . '1';
                $nombreReferencial = $year . $mascaraActual . '.' . $extension;
            }
            else {
                $proximoValor = (int)substr($lastName, 4, $mascara) + 1;
                $mascaraActual = str_pad($val,$mascara - strlen($proximoValor), '0') . $proximoValor;
                $nombreReferencial = $year . $mascaraActual . '.' . $extension;
            }
            // Guardo en la tabla documento
            $documento  = $em->getRepository('AppBundle:Documentos')->agregarDocumento($user, $adjuntoNombre, $nombreReferencial);
            if(is_string($documento)) {
                $arreglo = array('valido' => false,
                    'mensaje' => $documento);
            }
            else {
                $idDocumento = $documento->getId();
                $vinculo = 'http://'.$_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . '/contfin/web/' . $destino . $adjuntoNombre;

                $arreglo = array('valido' => true,
                    'nombreAdjunto' => $adjuntoNombre,
                    'vinculo' => $vinculo,
                    'idDocumento' => $idDocumento);
            }
        } else {
            $arreglo = array('valido' => false,
                'mensaje' => '¡Este fichero no se pudo adjuntar!');;
        }

        $result = json_encode($arreglo);
        return new JsonResponse($result);
    }

    /**
     * @Route("/adjuntoEliminar", name="adjuntoEliminar")
     */
    public function adjuntoEliminarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peticion = Request::createFromGlobals();
        $idDocumento = $peticion->request->get('idDocumento');
        $idExpediente = $peticion->request->get('idExpediente');

        if($idExpediente != 0)
        {
            $evidenciaDocumento = $em->getRepository('AppBundle:Documentos')->eliminarEvidenciaDocumento($idDocumento,$idExpediente);

            if($evidenciaDocumento === 'ok'){
                $documento = $em->getRepository('AppBundle:Documentos')->eliminarDocumento($idDocumento);
                if($documento === 'ok'){
                    $msg = 'ok';
                } else {
                    return new Response($documento);
                }
            } else {
                return new Response($evidenciaDocumento);
            }
        }else{
            $documento = $em->getRepository('AppBundle:Documentos')->eliminarDocumento($idDocumento);
            if($documento === 'ok'){
                $msg = 'ok';
            } else {
                return new Response($documento);
            }
        }

        return new Response($msg);
    }

    //descargar ayuda
    /**
     * @Route("/descargarAyuda", name="descargarAyuda")
     **/
    public function descargarAyudaAction(){

        $path = $this->get('kernel')->getRootDir(). "/../web/ayuda/";
        $content = file_get_contents($path.'Manual Usuario CONTFIN v1.0.pdf');

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.'Manual Usuario CONTFIN v1.0.pdf');

        $response->setContent($content);
        return $response;
    }
}
