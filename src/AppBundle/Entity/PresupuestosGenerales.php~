<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuestosgenerales
 *
 * @ORM\Table(name="presupuestosgenerales", indexes={@ORM\Index(name="Ref2323", columns={"numeroeconomico_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresupuestosgeneralesRepository")
 */
class Presupuestosgenerales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="presupuestosgenerales_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=true)
     */
    private $anno;

    /**
     * @var string
     *
     * @ORM\Column(name="codigonuevo", type="string", length=25, nullable=true)
     */
    private $codigonuevo;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuestoanterior", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $presupuestoanterior;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuesto", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $presupuesto;

    /**
     * @var \Numeroseconomicos
     *
     * @ORM\ManyToOne(targetEntity="Numeroseconomicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numeroeconomico_id", referencedColumnName="id")
     * })
     */
    private $numeroeconomico;



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
     * Set anno
     *
     * @param integer $anno
     *
     * @return Presupuestosgenerales
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set codigonuevo
     *
     * @param string $codigonuevo
     *
     * @return Presupuestosgenerales
     */
    public function setCodigonuevo($codigonuevo)
    {
        $this->codigonuevo = $codigonuevo;

        return $this;
    }

    /**
     * Get codigonuevo
     *
     * @return string
     */
    public function getCodigonuevo()
    {
        return $this->codigonuevo;
    }

    /**
     * Set presupuestoanterior
     *
     * @param string $presupuestoanterior
     *
     * @return Presupuestosgenerales
     */
    public function setPresupuestoanterior($presupuestoanterior)
    {
        $this->presupuestoanterior = $presupuestoanterior;

        return $this;
    }

    /**
     * Get presupuestoanterior
     *
     * @return string
     */
    public function getPresupuestoanterior()
    {
        return $this->presupuestoanterior;
    }

    /**
     * Set presupuesto
     *
     * @param string $presupuesto
     *
     * @return Presupuestosgenerales
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return string
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set numeroeconomico
     *
     * @param \AppBundle\Entity\Numeroseconomicos $numeroeconomico
     *
     * @return Presupuestosgenerales
     */
    public function setNumeroeconomico(\AppBundle\Entity\Numeroseconomicos $numeroeconomico = null)
    {
        $this->numeroeconomico = $numeroeconomico;

        return $this;
    }

    /**
     * Get numeroeconomico
     *
     * @return \AppBundle\Entity\Numeroseconomicos
     */
    public function getNumeroeconomico()
    {
        return $this->numeroeconomico;
    }
}
