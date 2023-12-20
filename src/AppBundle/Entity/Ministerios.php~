<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministerios
 *
 * @ORM\Table(name="ministerios", indexes={@ORM\Index(name="Ref180", columns={"seccion_id"}), @ORM\Index(name="Ref1181", columns={"areasocial_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinisteriosRepository")
 */
class Ministerios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ministerios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prefijoministerio", type="string", length=150, nullable=true)
     */
    private $prefijoministerio;

    /**
     * @var string
     *
     * @ORM\Column(name="siglaministerio", type="string", length=25, nullable=true)
     */
    private $siglaministerio;

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
     * Set prefijoministerio
     *
     * @param string $prefijoministerio
     *
     * @return Ministerios
     */
    public function setPrefijoministerio($prefijoministerio)
    {
        $this->prefijoministerio = $prefijoministerio;

        return $this;
    }

    /**
     * Get prefijoministerio
     *
     * @return string
     */
    public function getPrefijoministerio()
    {
        return $this->prefijoministerio;
    }

    /**
     * Set siglaministerio
     *
     * @param string $siglaministerio
     *
     * @return Ministerios
     */
    public function setSiglaministerio($siglaministerio)
    {
        $this->siglaministerio = $siglaministerio;

        return $this;
    }

    /**
     * Get siglaministerio
     *
     * @return string
     */
    public function getSiglaministerio()
    {
        return $this->siglaministerio;
    }

    /**
     * Set seccion
     *
     * @param \AppBundle\Entity\Secciones $seccion
     *
     * @return Ministerios
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
