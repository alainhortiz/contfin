<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Capitulos
 *
 * @ORM\Table(name="capitulos", indexes={@ORM\Index(name="Ref2221", columns={"grupoasociativo_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CapitulosRepository")
 */
class Capitulos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="capitulos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigocapitulo", type="string", length=25, nullable=false)
     */
    private $codigocapitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrecapitulo", type="string", length=255, nullable=false)
     */
    private $nombrecapitulo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipoconcepto", type="boolean", nullable=false)
     */
    private $tipoconcepto = true;

    /**
     * @var \Gruposasociativos
     *
     * @ORM\ManyToOne(targetEntity="Gruposasociativos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupoasociativo_id", referencedColumnName="id")
     * })
     */
    private $grupoasociativo;



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
     * Set codigocapitulo
     *
     * @param string $codigocapitulo
     *
     * @return Capitulos
     */
    public function setCodigocapitulo($codigocapitulo)
    {
        $this->codigocapitulo = $codigocapitulo;

        return $this;
    }

    /**
     * Get codigocapitulo
     *
     * @return string
     */
    public function getCodigocapitulo()
    {
        return $this->codigocapitulo;
    }

    /**
     * Set nombrecapitulo
     *
     * @param string $nombrecapitulo
     *
     * @return Capitulos
     */
    public function setNombrecapitulo($nombrecapitulo)
    {
        $this->nombrecapitulo = $nombrecapitulo;

        return $this;
    }

    /**
     * Get nombrecapitulo
     *
     * @return string
     */
    public function getNombrecapitulo()
    {
        return $this->nombrecapitulo;
    }

    /**
     * Set tipoconcepto
     *
     * @param boolean $tipoconcepto
     *
     * @return Capitulos
     */
    public function setTipoconcepto($tipoconcepto)
    {
        $this->tipoconcepto = $tipoconcepto;

        return $this;
    }

    /**
     * Get tipoconcepto
     *
     * @return boolean
     */
    public function getTipoconcepto()
    {
        return $this->tipoconcepto;
    }

    /**
     * Set grupoasociativo
     *
     * @param \AppBundle\Entity\Gruposasociativos $grupoasociativo
     *
     * @return Capitulos
     */
    public function setGrupoasociativo(\AppBundle\Entity\Gruposasociativos $grupoasociativo = null)
    {
        $this->grupoasociativo = $grupoasociativo;

        return $this;
    }

    /**
     * Get grupoasociativo
     *
     * @return \AppBundle\Entity\Gruposasociativos
     */
    public function getGrupoasociativo()
    {
        return $this->grupoasociativo;
    }
}
