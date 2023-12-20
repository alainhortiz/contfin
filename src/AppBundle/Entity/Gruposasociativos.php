<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gruposasociativos
 *
 * @ORM\Table(name="gruposasociativos", indexes={@ORM\Index(name="Ref2276", columns={"grupoasociativopadre_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GruposasociativosRepository")
 */
class Gruposasociativos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="gruposasociativos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigogrupoasociativo", type="string", length=25, nullable=true)
     */
    private $codigogrupoasociativo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombregrupoasociativo", type="string", length=255, nullable=false)
     */
    private $nombregrupoasociativo;

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
     *   @ORM\JoinColumn(name="grupoasociativopadre_id", referencedColumnName="id")
     * })
     */
    private $grupoasociativopadre;



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
     * Set codigogrupoasociativo
     *
     * @param string $codigogrupoasociativo
     *
     * @return Gruposasociativos
     */
    public function setCodigogrupoasociativo($codigogrupoasociativo)
    {
        $this->codigogrupoasociativo = $codigogrupoasociativo;

        return $this;
    }

    /**
     * Get codigogrupoasociativo
     *
     * @return string
     */
    public function getCodigogrupoasociativo()
    {
        return $this->codigogrupoasociativo;
    }

    /**
     * Set nombregrupoasociativo
     *
     * @param string $nombregrupoasociativo
     *
     * @return Gruposasociativos
     */
    public function setNombregrupoasociativo($nombregrupoasociativo)
    {
        $this->nombregrupoasociativo = $nombregrupoasociativo;

        return $this;
    }

    /**
     * Get nombregrupoasociativo
     *
     * @return string
     */
    public function getNombregrupoasociativo()
    {
        return $this->nombregrupoasociativo;
    }

    /**
     * Set tipoconcepto
     *
     * @param boolean $tipoconcepto
     *
     * @return Gruposasociativos
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
     * Set grupoasociativopadre
     *
     * @param \AppBundle\Entity\Gruposasociativos $grupoasociativopadre
     *
     * @return Gruposasociativos
     */
    public function setGrupoasociativopadre(\AppBundle\Entity\Gruposasociativos $grupoasociativopadre = null)
    {
        $this->grupoasociativopadre = $grupoasociativopadre;

        return $this;
    }

    /**
     * Get grupoasociativopadre
     *
     * @return \AppBundle\Entity\Gruposasociativos
     */
    public function getGrupoasociativopadre()
    {
        return $this->grupoasociativopadre;
    }
}
