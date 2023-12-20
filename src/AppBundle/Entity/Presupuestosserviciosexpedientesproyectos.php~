<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuestosserviciosexpedientesproyectos
 *
 * @ORM\Table(name="presupuestosserviciosexpedientesproyectos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresupuestosserviciosexpedientesproyectosRepository")
 */
class Presupuestosserviciosexpedientesproyectos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="presupuestosserviciosexpedientesproyectos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="importesolicitado", type="decimal", precision=18, scale=3, nullable=false)
     */
    private $importesolicitado = '0';

    /**
     * @var \Presupuestosserviciosexpedientes
     *
     * @ORM\ManyToOne(targetEntity="Presupuestosserviciosexpedientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="presupuestoservicioexpediente_id", referencedColumnName="id")
     * })
     */
    private $presupuestoservicioexpediente;

    /**
     * @var \Presupuestosproyectos
     *
     * @ORM\ManyToOne(targetEntity="Presupuestosproyectos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="presupuestoproyecto_id", referencedColumnName="id")
     * })
     */
    private $presupuestoproyecto;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Presupuestosserviciosexpedientesproyectos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set importesolicitado
     *
     * @param string $importesolicitado
     *
     * @return Presupuestosserviciosexpedientesproyectos
     */
    public function setImportesolicitado($importesolicitado)
    {
        $this->importesolicitado = $importesolicitado;

        return $this;
    }

    /**
     * Get importesolicitado
     *
     * @return string
     */
    public function getImportesolicitado()
    {
        return $this->importesolicitado;
    }

    /**
     * Set presupuestoservicioexpediente
     *
     * @param \AppBundle\Entity\Presupuestosserviciosexpedientes $presupuestoservicioexpediente
     *
     * @return Presupuestosserviciosexpedientesproyectos
     */
    public function setPresupuestoservicioexpediente(\AppBundle\Entity\Presupuestosserviciosexpedientes $presupuestoservicioexpediente = null)
    {
        $this->presupuestoservicioexpediente = $presupuestoservicioexpediente;

        return $this;
    }

    /**
     * Get presupuestoservicioexpediente
     *
     * @return \AppBundle\Entity\Presupuestosserviciosexpedientes
     */
    public function getPresupuestoservicioexpediente()
    {
        return $this->presupuestoservicioexpediente;
    }

    /**
     * Set presupuestoproyecto
     *
     * @param \AppBundle\Entity\Presupuestosproyectos $presupuestoproyecto
     *
     * @return Presupuestosserviciosexpedientesproyectos
     */
    public function setPresupuestoproyecto(\AppBundle\Entity\Presupuestosproyectos $presupuestoproyecto = null)
    {
        $this->presupuestoproyecto = $presupuestoproyecto;

        return $this;
    }

    /**
     * Get presupuestoproyecto
     *
     * @return \AppBundle\Entity\Presupuestosproyectos
     */
    public function getPresupuestoproyecto()
    {
        return $this->presupuestoproyecto;
    }
}
