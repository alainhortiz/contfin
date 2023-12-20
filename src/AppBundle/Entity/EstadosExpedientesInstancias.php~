<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadosexpedientesinstancias
 *
 * @ORM\Table(name="estadosexpedientesinstancias", indexes={@ORM\Index(name="Ref2733", columns={"instancia_id"}), @ORM\Index(name="Ref4478", columns={"estadoexpediente_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadosexpedientesinstanciasRepository")
 */
class Estadosexpedientesinstancias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="estadosexpedientesinstancias_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Estadosexpedientes
     *
     * @ORM\ManyToOne(targetEntity="Estadosexpedientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadoexpediente_id", referencedColumnName="id")
     * })
     */
    private $estadoexpediente;

    /**
     * @var \Instancias
     *
     * @ORM\ManyToOne(targetEntity="Instancias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="instancia_id", referencedColumnName="id")
     * })
     */
    private $instancia;



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
     * Set estadoexpediente
     *
     * @param \AppBundle\Entity\Estadosexpedientes $estadoexpediente
     *
     * @return Estadosexpedientesinstancias
     */
    public function setEstadoexpediente(\AppBundle\Entity\Estadosexpedientes $estadoexpediente = null)
    {
        $this->estadoexpediente = $estadoexpediente;

        return $this;
    }

    /**
     * Get estadoexpediente
     *
     * @return \AppBundle\Entity\Estadosexpedientes
     */
    public function getEstadoexpediente()
    {
        return $this->estadoexpediente;
    }

    /**
     * Set instancia
     *
     * @param \AppBundle\Entity\Instancias $instancia
     *
     * @return Estadosexpedientesinstancias
     */
    public function setInstancia(\AppBundle\Entity\Instancias $instancia = null)
    {
        $this->instancia = $instancia;

        return $this;
    }

    /**
     * Get instancia
     *
     * @return \AppBundle\Entity\Instancias
     */
    public function getInstancia()
    {
        return $this->instancia;
    }
}
