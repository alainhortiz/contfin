<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mandamientospagosexpedientes
 *
 * @ORM\Table(name="mandamientospagosexpedientes", indexes={@ORM\Index(name="Ref1579", columns={"expediente_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MandamientospagosexpedientesRepository")
 */
class Mandamientospagosexpedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mandamientospagosexpedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numeromandamientopago", type="string", length=25, nullable=false)
     */
    private $numeromandamientopago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechamandamientopago", type="datetime", nullable=false)
     */
    private $fechamandamientopago;

    /**
     * @var string
     *
     * @ORM\Column(name="importemandamientopago", type="decimal", precision=18, scale=3, nullable=false)
     */
    private $importemandamientopago;

    /**
     * @var \Expedientes
     *
     * @ORM\ManyToOne(targetEntity="Expedientes" , inversedBy="mandamientosPagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     * })
     */
    private $expediente;



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
     * Set numeromandamientopago
     *
     * @param string $numeromandamientopago
     *
     * @return Mandamientospagosexpedientes
     */
    public function setNumeromandamientopago($numeromandamientopago)
    {
        $this->numeromandamientopago = $numeromandamientopago;

        return $this;
    }

    /**
     * Get numeromandamientopago
     *
     * @return string
     */
    public function getNumeromandamientopago()
    {
        return $this->numeromandamientopago;
    }

    /**
     * Set fechamandamientopago
     *
     * @param \DateTime $fechamandamientopago
     *
     * @return Mandamientospagosexpedientes
     */
    public function setFechamandamientopago($fechamandamientopago)
    {
        $this->fechamandamientopago = $fechamandamientopago;

        return $this;
    }

    /**
     * Get fechamandamientopago
     *
     * @return \DateTime
     */
    public function getFechamandamientopago()
    {
        return $this->fechamandamientopago;
    }

    /**
     * Set importemandamientopago
     *
     * @param string $importemandamientopago
     *
     * @return Mandamientospagosexpedientes
     */
    public function setImportemandamientopago($importemandamientopago)
    {
        $this->importemandamientopago = $importemandamientopago;

        return $this;
    }

    /**
     * Get importemandamientopago
     *
     * @return string
     */
    public function getImportemandamientopago()
    {
        return $this->importemandamientopago;
    }

    /**
     * Set expediente
     *
     * @param \AppBundle\Entity\Expedientes $expediente
     *
     * @return Mandamientospagosexpedientes
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
}
