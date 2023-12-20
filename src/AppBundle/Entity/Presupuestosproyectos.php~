<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuestosproyectos
 *
 * @ORM\Table(name="presupuestosproyectos", indexes={@ORM\Index(name="Ref1313", columns={"categoriaproyecto_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresupuestosproyectosRepository")
 */
class Presupuestosproyectos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="presupuestosproyectos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=false)
     */
    private $anno;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoproyecto", type="string", length=25, nullable=false)
     */
    private $codigoproyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreproyecto", type="string", length=255, nullable=false)
     */
    private $nombreproyecto;

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
     * @var \Categoriasproyectos
     *
     * @ORM\ManyToOne(targetEntity="Categoriasproyectos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoriaproyecto_id", referencedColumnName="id")
     * })
     */
    private $categoriaproyecto;

    /**
     * @var \Presupuestosservicios
     *
     * @ORM\ManyToOne(targetEntity="Presupuestosservicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="presupuestoservicio_id", referencedColumnName="id")
     * })
     */
    private $presupuestoservicio;



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
     * @return Presupuestosproyectos
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
     * Set codigoproyecto
     *
     * @param string $codigoproyecto
     *
     * @return Presupuestosproyectos
     */
    public function setCodigoproyecto($codigoproyecto)
    {
        $this->codigoproyecto = $codigoproyecto;

        return $this;
    }

    /**
     * Get codigoproyecto
     *
     * @return string
     */
    public function getCodigoproyecto()
    {
        return $this->codigoproyecto;
    }

    /**
     * Set nombreproyecto
     *
     * @param string $nombreproyecto
     *
     * @return Presupuestosproyectos
     */
    public function setNombreproyecto($nombreproyecto)
    {
        $this->nombreproyecto = $nombreproyecto;

        return $this;
    }

    /**
     * Get nombreproyecto
     *
     * @return string
     */
    public function getNombreproyecto()
    {
        return $this->nombreproyecto;
    }

    /**
     * Set presupuesto
     *
     * @param string $presupuesto
     *
     * @return Presupuestosproyectos
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
     * Set categoriaproyecto
     *
     * @param \AppBundle\Entity\Categoriasproyectos $categoriaproyecto
     *
     * @return Presupuestosproyectos
     */
    public function setCategoriaproyecto(\AppBundle\Entity\Categoriasproyectos $categoriaproyecto = null)
    {
        $this->categoriaproyecto = $categoriaproyecto;

        return $this;
    }

    /**
     * Get categoriaproyecto
     *
     * @return \AppBundle\Entity\Categoriasproyectos
     */
    public function getCategoriaproyecto()
    {
        return $this->categoriaproyecto;
    }

    /**
     * Set valorejecutado
     *
     * @param string $valorejecutado
     *
     * @return Presupuestosproyectos
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
     * @return Presupuestosproyectos
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
     * @return Presupuestosproyectos
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
     * @return Presupuestosproyectos
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
     * @return Presupuestosproyectos
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
     * Set presupuestoservicio
     *
     * @param \AppBundle\Entity\Presupuestosservicios $presupuestoservicio
     *
     * @return Presupuestosproyectos
     */
    public function setPresupuestoservicio(\AppBundle\Entity\Presupuestosservicios $presupuestoservicio = null)
    {
        $this->presupuestoservicio = $presupuestoservicio;

        return $this;
    }

    /**
     * Get presupuestoservicio
     *
     * @return \AppBundle\Entity\Presupuestosservicios
     */
    public function getPresupuestoservicio()
    {
        return $this->presupuestoservicio;
    }
}
