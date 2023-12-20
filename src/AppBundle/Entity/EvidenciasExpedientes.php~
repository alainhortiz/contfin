<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evidenciasexpedientes
 *
 * @ORM\Table(name="evidenciasexpedientes", indexes={@ORM\Index(name="Ref1514", columns={"expediente_id"}), @ORM\Index(name="Ref1715", columns={"documento_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvidenciasexpedientesRepository")
 */
class Evidenciasexpedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="evidenciasexpedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Expedientes
     *
     * @ORM\ManyToOne(targetEntity="Expedientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     * })
     */
    private $expediente;

    /**
     * @var \Documentos
     *
     * @ORM\ManyToOne(targetEntity="Documentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="documento_id", referencedColumnName="id")
     * })
     */
    private $documento;



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
     * Set expediente
     *
     * @param \AppBundle\Entity\Expedientes $expediente
     *
     * @return Evidenciasexpedientes
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
     * Set documento
     *
     * @param \AppBundle\Entity\Documentos $documento
     *
     * @return Evidenciasexpedientes
     */
    public function setDocumento(\AppBundle\Entity\Documentos $documento = null)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return \AppBundle\Entity\Documentos
     */
    public function getDocumento()
    {
        return $this->documento;
    }
}
