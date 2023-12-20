<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Servicios
 *
 * @ORM\Table(name="servicios", indexes={@ORM\Index(name="Ref14", columns={"seccion_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiciosRepository")
 */
class Servicios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="servicios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoservicio", type="string", length=25, nullable=false)
     */
    private $codigoservicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreservicio", type="string", length=255, nullable=false)
     */
    private $nombreservicio;

    /**
     * @var \Secciones
     *
     * @ORM\ManyToOne(targetEntity="Secciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seccion_id", referencedColumnName="id")
     * })
     */
    private $seccion;

    /**
     * @ORM\OneToMany(targetEntity="Presupuestosservicios", mappedBy="servicio")
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
     * Set codigoservicio
     *
     * @param string $codigoservicio
     *
     * @return Servicios
     */
    public function setCodigoservicio($codigoservicio)
    {
        $this->codigoservicio = $codigoservicio;

        return $this;
    }

    /**
     * Get codigoservicio
     *
     * @return string
     */
    public function getCodigoservicio()
    {
        return $this->codigoservicio;
    }

    /**
     * Set nombreservicio
     *
     * @param string $nombreservicio
     *
     * @return Servicios
     */
    public function setNombreservicio($nombreservicio)
    {
        $this->nombreservicio = $nombreservicio;

        return $this;
    }

    /**
     * Get nombreservicio
     *
     * @return string
     */
    public function getNombreservicio()
    {
        return $this->nombreservicio;
    }

    /**
     * Set seccion
     *
     * @param \AppBundle\Entity\Secciones $seccion
     *
     * @return Servicios
     */
    public function setSeccion(\AppBundle\Entity\Secciones $seccion = null)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return \AppBundle\Entity\Secciones
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Add presupuesto
     *
     * @param \AppBundle\Entity\Presupuestosservicios $presupuesto
     *
     * @return Servicios
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
