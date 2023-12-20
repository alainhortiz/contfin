<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Instancias
 *
 * @ORM\Table(name="instancias", indexes={@ORM\Index(name="Ref2777", columns={"instanciapadre_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstanciasRepository")
 */
class Instancias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="instancias_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreinstancia", type="string", length=255, nullable=false)
     */
    private $nombreinstancia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="preorden", type="integer", nullable=true)
     */
    private $preorden;

    /**
     * @var \Instancias
     *
     * @ORM\ManyToOne(targetEntity="Instancias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instanciapadre_id", referencedColumnName="id")
     * })
     */
    private $instanciapadre;



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
     * Set nombreinstancia
     *
     * @param string $nombreinstancia
     *
     * @return Instancias
     */
    public function setNombreinstancia($nombreinstancia)
    {
        $this->nombreinstancia = $nombreinstancia;

        return $this;
    }

    /**
     * Get nombreinstancia
     *
     * @return string
     */
    public function getNombreinstancia()
    {
        return $this->nombreinstancia;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Instancias
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
     * Set preorden
     *
     * @param integer $preorden
     *
     * @return Instancias
     */
    public function setPreorden($preorden)
    {
        $this->preorden = $preorden;

        return $this;
    }

    /**
     * Get preorden
     *
     * @return integer
     */
    public function getPreorden()
    {
        return $this->preorden;
    }

    /**
     * Set instanciapadre
     *
     * @param \AppBundle\Entity\Instancias $instanciapadre
     *
     * @return Instancias
     */
    public function setInstanciapadre(\AppBundle\Entity\Instancias $instanciapadre = null)
    {
        $this->instanciapadre = $instanciapadre;

        return $this;
    }

    /**
     * Get instanciapadre
     *
     * @return \AppBundle\Entity\Instancias
     */
    public function getInstanciapadre()
    {
        return $this->instanciapadre;
    }
}
