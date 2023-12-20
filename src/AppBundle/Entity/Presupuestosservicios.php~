<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuestosservicios
 *
 * @ORM\Table(name="presupuestosservicios", indexes={@ORM\Index(name="Ref85", columns={"servicio_id"}), @ORM\Index(name="Ref2324", columns={"numeroeconomico_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresupuestosserviciosRepository")
 */
class Presupuestosservicios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="presupuestosservicios_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @ORM\Column(name="valorejecutado", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $valorejecutado;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuestoreal", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $presupuestoreal;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuestorealunitario", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $presupuestorealunitario;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuestounitario", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $presupuestounitario;

    /**
     * @var string
     *
     * @ORM\Column(name="valordisponible", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $valordisponible;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inactivo", type="boolean", nullable=false)
     */
    private $inactivo = false;

    /**
     * @var \Servicios
     *
     * @ORM\ManyToOne(targetEntity="Servicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_id", referencedColumnName="id")
     * })
     */
    private $servicio;

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
     * @ORM\OneToMany(targetEntity="Presupuestosproyectos", mappedBy="presupuestoservicio")
     */
    private $presupuestosproyectos;

    /**
     * Presupuestosservicios constructor.
     */
    public function __construct()
    {
        $this->presupuestosproyectos = new ArrayCollection();
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
     * Set anno
     *
     * @param integer $anno
     *
     * @return Presupuestosservicios
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
     * @return Presupuestosservicios
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
     * @return Presupuestosservicios
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
     * @return Presupuestosservicios
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
     * Set servicio
     *
     * @param \AppBundle\Entity\Servicios $servicio
     *
     * @return Presupuestosservicios
     */
    public function setServicio(\AppBundle\Entity\Servicios $servicio = null)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return \AppBundle\Entity\Servicios
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set numeroeconomico
     *
     * @param \AppBundle\Entity\Numeroseconomicos $numeroeconomico
     *
     * @return Presupuestosservicios
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

    /**
     * Set valorejecutado
     *
     * @param string $valorejecutado
     *
     * @return Presupuestosservicios
     */
    public function setValorejecutado($valorejecutado)
    {
        $this->valorejecutado = $valorejecutado;

        return $this;
    }

    /**
     * Get valorejecutado
     *
     * @return string
     */
    public function getValorejecutado()
    {
        return $this->valorejecutado;
    }

    /**
     * Set presupuestoreal
     *
     * @param string $presupuestoreal
     *
     * @return Presupuestosservicios
     */
    public function setPresupuestoreal($presupuestoreal)
    {
        $this->presupuestoreal = $presupuestoreal;

        return $this;
    }

    /**
     * Get presupuestoreal
     *
     * @return string
     */
    public function getPresupuestoreal()
    {
        return $this->presupuestoreal;
    }

    /**
     * Set presupuestorealunitario
     *
     * @param string $presupuestorealunitario
     *
     * @return Presupuestosservicios
     */
    public function setPresupuestorealunitario($presupuestorealunitario)
    {
        $this->presupuestorealunitario = $presupuestorealunitario;

        return $this;
    }

    /**
     * Get presupuestorealunitario
     *
     * @return string
     */
    public function getPresupuestorealunitario()
    {
        return $this->presupuestorealunitario;
    }

    /**
     * Set presupuestounitario
     *
     * @param string $presupuestounitario
     *
     * @return Presupuestosservicios
     */
    public function setPresupuestounitario($presupuestounitario)
    {
        $this->presupuestounitario = $presupuestounitario;

        return $this;
    }

    /**
     * Get presupuestounitario
     *
     * @return string
     */
    public function getPresupuestounitario()
    {
        return $this->presupuestounitario;
    }

    /**
     * Set valordisponible
     *
     * @param string $valordisponible
     *
     * @return Presupuestosservicios
     */
    public function setValordisponible($valordisponible)
    {
        $this->valordisponible = $valordisponible;

        return $this;
    }

    /**
     * Get valordisponible
     *
     * @return string
     */
    public function getValordisponible()
    {
        return $this->valordisponible;
    }

    /**
     * Set inactivo
     *
     * @param boolean $inactivo
     *
     * @return Presupuestosservicios
     */
    public function setInactivo($inactivo)
    {
        $this->inactivo = $inactivo;

        return $this;
    }

    /**
     * Get inactivo
     *
     * @return boolean
     */
    public function getInactivo()
    {
        return $this->inactivo;
    }

    /**
     * Add presupuestosproyecto
     *
     * @param \AppBundle\Entity\Presupuestosproyectos $presupuestosproyecto
     *
     * @return Presupuestosservicios
     */
    public function addPresupuestosproyecto(\AppBundle\Entity\Presupuestosproyectos $presupuestosproyecto)
    {
        $this->presupuestosproyectos[] = $presupuestosproyecto;

        return $this;
    }

    /**
     * Remove presupuestosproyecto
     *
     * @param \AppBundle\Entity\Presupuestosproyectos $presupuestosproyecto
     */
    public function removePresupuestosproyecto(\AppBundle\Entity\Presupuestosproyectos $presupuestosproyecto)
    {
        $this->presupuestosproyectos->removeElement($presupuestosproyecto);
    }

    /**
     * Get presupuestosproyectos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresupuestosproyectos()
    {
        return $this->presupuestosproyectos;
    }
}
