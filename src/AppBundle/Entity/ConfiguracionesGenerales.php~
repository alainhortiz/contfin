<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracionesgenerales
 *
 * @ORM\Table(name="configuracionesgenerales")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfiguracionesgeneralesRepository")
 */
class Configuracionesgenerales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="configuracionesgenerales_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="caminorepositoriodocumento", type="string", length=255, nullable=true)
     */
    private $caminorepositoriodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="extensiondocumento", type="string", length=10, nullable=true)
     */
    private $extensiondocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="caracteresmascaradocumento", type="integer", nullable=false)
     */
    private $caracteresmascaradocumento = '10';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cambiocarpetadocumento", type="boolean", nullable=false)
     */
    private $cambiocarpetadocumento = true;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentajereserva", type="float", precision=10, scale=0, nullable=false)
     */
    private $porcentajereserva = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="caracteresmascaraexpediente", type="integer", nullable=false)
     */
    private $caracteresmascaraexpediente = '10';

    /**
     * @var string
     *
     * @ORM\Column(name="moneda", type="string", length=10, nullable=true)
     */
    private $moneda;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set caminorepositoriodocumento
     *
     * @param string $caminorepositoriodocumento
     *
     * @return Configuracionesgenerales
     */
    public function setCaminorepositoriodocumento($caminorepositoriodocumento)
    {
        $this->caminorepositoriodocumento = $caminorepositoriodocumento;

        return $this;
    }

    /**
     * Get caminorepositoriodocumento
     *
     * @return string
     */
    public function getCaminorepositoriodocumento()
    {
        return $this->caminorepositoriodocumento;
    }

    /**
     * Set extensiondocumento
     *
     * @param string $extensiondocumento
     *
     * @return Configuracionesgenerales
     */
    public function setExtensiondocumento($extensiondocumento)
    {
        $this->extensiondocumento = $extensiondocumento;

        return $this;
    }

    /**
     * Get extensiondocumento
     *
     * @return string
     */
    public function getExtensiondocumento()
    {
        return $this->extensiondocumento;
    }

    /**
     * Set caracteresmascaradocumento
     *
     * @param integer $caracteresmascaradocumento
     *
     * @return Configuracionesgenerales
     */
    public function setCaracteresmascaradocumento($caracteresmascaradocumento)
    {
        $this->caracteresmascaradocumento = $caracteresmascaradocumento;

        return $this;
    }

    /**
     * Get caracteresmascaradocumento
     *
     * @return integer
     */
    public function getCaracteresmascaradocumento()
    {
        return $this->caracteresmascaradocumento;
    }

    /**
     * Set cambiocarpetadocumento
     *
     * @param boolean $cambiocarpetadocumento
     *
     * @return Configuracionesgenerales
     */
    public function setCambiocarpetadocumento($cambiocarpetadocumento)
    {
        $this->cambiocarpetadocumento = $cambiocarpetadocumento;

        return $this;
    }

    /**
     * Get cambiocarpetadocumento
     *
     * @return boolean
     */
    public function getCambiocarpetadocumento()
    {
        return $this->cambiocarpetadocumento;
    }

    /**
     * Set porcentajereserva
     *
     * @param float $porcentajereserva
     *
     * @return Configuracionesgenerales
     */
    public function setPorcentajereserva($porcentajereserva)
    {
        $this->porcentajereserva = $porcentajereserva;

        return $this;
    }

    /**
     * Get porcentajereserva
     *
     * @return float
     */
    public function getPorcentajereserva()
    {
        return $this->porcentajereserva;
    }

    /**
     * Set caracteresmascaraexpediente
     *
     * @param integer $caracteresmascaraexpediente
     *
     * @return Configuracionesgenerales
     */
    public function setCaracteresmascaraexpediente($caracteresmascaraexpediente)
    {
        $this->caracteresmascaraexpediente = $caracteresmascaraexpediente;

        return $this;
    }

    /**
     * Get caracteresmascaraexpediente
     *
     * @return integer
     */
    public function getCaracteresmascaraexpediente()
    {
        return $this->caracteresmascaraexpediente;
    }

    /**
     * Set moneda
     *
     * @param string $moneda
     *
     * @return Configuracionesgenerales
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return string
     */
    public function getMoneda()
    {
        return $this->moneda;
    }
}
