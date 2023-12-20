<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registrosexpedientes
 *
 * @ORM\Table(name="registrosexpedientes", indexes={@ORM\Index(name="Ref1585", columns={"expediente_id"}), @ORM\Index(name="Ref4686", columns={"ministerio_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrosexpedientesRepository")
 */
class Registrosexpedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="registrosexpedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id = 'public.registrosexpedientes_id_seq';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecharegistro", type="datetime", nullable=false)
     */
    private $fecharegistro = 'now()';

    /**
     * @var string
     *
     * @ORM\Column(name="numeroregistro", type="string", length=25, nullable=false)
     */
    private $numeroregistro;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255, nullable=true)
     */
    private $departamento;

    /**
     * @var \Expedientes
     *
     * @ORM\ManyToOne(targetEntity="Expedientes", inversedBy="registros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     * })
     */
    private $expediente;

    /**
     * @var \Ministerios
     *
     * @ORM\ManyToOne(targetEntity="Ministerios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ministerio_id", referencedColumnName="id")
     * })
     */
    private $ministerio;



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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return Registrosexpedientes
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set numeroregistro
     *
     * @param string $numeroregistro
     *
     * @return Registrosexpedientes
     */
    public function setNumeroregistro($numeroregistro)
    {
        $this->numeroregistro = $numeroregistro;

        return $this;
    }

    /**
     * Get numeroregistro
     *
     * @return string
     */
    public function getNumeroregistro()
    {
        return $this->numeroregistro;
    }

    /**
     * Set expediente
     *
     * @param \AppBundle\Entity\Expedientes $expediente
     *
     * @return Registrosexpedientes
     */
    public function setExpediente(\AppBundle\Entity\Expedientes $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente
     *
     * @return \AppBundle\Entity\Expedientes
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set ministerio
     *
     * @param \AppBundle\Entity\Ministerios $ministerio
     *
     * @return Registrosexpedientes
     */
    public function setMinisterio(\AppBundle\Entity\Ministerios $ministerio = null)
    {
        $this->ministerio = $ministerio;

        return $this;
    }

    /**
     * Get ministerio
     *
     * @return \AppBundle\Entity\Ministerios
     */
    public function getMinisterio()
    {
        return $this->ministerio;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     *
     * @return Registrosexpedientes
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }
}
