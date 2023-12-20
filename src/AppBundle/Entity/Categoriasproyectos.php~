<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriasproyectos
 *
 * @ORM\Table(name="categoriasproyectos", indexes={@ORM\Index(name="Ref4682", columns={"ministerio_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriasproyectosRepository")
 */
class Categoriasproyectos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="categoriasproyectos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrecategoriaproyecto", type="string", length=255, nullable=false)
     */
    private $nombrecategoriaproyecto;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombrecategoriaproyecto
     *
     * @param string $nombrecategoriaproyecto
     *
     * @return Categoriasproyectos
     */
    public function setNombrecategoriaproyecto($nombrecategoriaproyecto)
    {
        $this->nombrecategoriaproyecto = $nombrecategoriaproyecto;

        return $this;
    }

    /**
     * Get nombrecategoriaproyecto
     *
     * @return string
     */
    public function getNombrecategoriaproyecto()
    {
        return $this->nombrecategoriaproyecto;
    }


    /**
     * Set seccion
     *
     * @param \AppBundle\Entity\Secciones $seccion
     *
     * @return Categoriasproyectos
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
}
