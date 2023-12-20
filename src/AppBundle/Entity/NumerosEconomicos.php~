<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Numeroseconomicos
 *
 * @ORM\Table(name="numeroseconomicos", indexes={@ORM\Index(name="Ref222", columns={"capitulo_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NumeroseconomicosRepository")
 */
class Numeroseconomicos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="numeroseconomicos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigonumeroeconomico", type="string", length=25, nullable=false)
     */
    private $codigonumeroeconomico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrenumeroeconomico", type="string", length=255, nullable=false)
     */
    private $nombrenumeroeconomico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipoconcepto", type="boolean", nullable=false)
     */
    private $tipoconcepto = true;

    /**
     * @var \Capitulos
     *
     * @ORM\ManyToOne(targetEntity="Capitulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="capitulo_id", referencedColumnName="id")
     * })
     */
    private $capitulo;

    /**
     * @ORM\OneToMany(targetEntity="Presupuestosservicios", mappedBy="numeroeconomico")
     */
    private $presupuestos;

    /**
     * Servicios constructor.
     */
    public function __construct()
    {
        $this->presupuestos = new ArrayCollection();
    }



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
     * Set codigonumeroeconomico
     *
     * @param string $codigonumeroeconomico
     *
     * @return Numeroseconomicos
     */
    public function setCodigonumeroeconomico($codigonumeroeconomico)
    {
        $this->codigonumeroeconomico = $codigonumeroeconomico;

        return $this;
    }

    /**
     * Get codigonumeroeconomico
     *
     * @return string
     */
    public function getCodigonumeroeconomico()
    {
        return $this->codigonumeroeconomico;
    }

    /**
     * Set nombrenumeroeconomico
     *
     * @param string $nombrenumeroeconomico
     *
     * @return Numeroseconomicos
     */
    public function setNombrenumeroeconomico($nombrenumeroeconomico)
    {
        $this->nombrenumeroeconomico = $nombrenumeroeconomico;

        return $this;
    }

    /**
     * Get nombrenumeroeconomico
     *
     * @return string
     */
    public function getNombrenumeroeconomico()
    {
        return $this->nombrenumeroeconomico;
    }

    /**
     * Set tipoconcepto
     *
     * @param boolean $tipoconcepto
     *
     * @return Numeroseconomicos
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
     * Set capitulo
     *
     * @param \AppBundle\Entity\Capitulos $capitulo
     *
     * @return Numeroseconomicos
     */
    public function setCapitulo(\AppBundle\Entity\Capitulos $capitulo = null)
    {
        $this->capitulo = $capitulo;

        return $this;
    }

    /**
     * Get capitulo
     *
     * @return \AppBundle\Entity\Capitulos
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }

    public function getArticulo(){

        return substr($this->codigonumeroeconomico , 0 , 2);
    }

    /**
     * Add presupuesto
     *
     * @param \AppBundle\Entity\Presupuestosservicios $presupuesto
     *
     * @return Numeroseconomicos
     */
    public function addPresupuesto(\AppBundle\Entity\Presupuestosservicios $presupuesto)
    {
        $this->presupuestos[] = $presupuesto;

        return $this;
    }

    /**
     * Remove presupuesto
     *
     * @param \AppBundle\Entity\Presupuestosservicios $presupuesto
     */
    public function removePresupuesto(\AppBundle\Entity\Presupuestosservicios $presupuesto)
    {
        $this->presupuestos->removeElement($presupuesto);
    }

    /**
     * Get presupuestos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresupuestos()
    {
        return $this->presupuestos;
    }
}
