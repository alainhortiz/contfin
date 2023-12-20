<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documentos
 *
 * @ORM\Table(name="documentos", indexes={@ORM\Index(name="Ref2642", columns={"usuario_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocumentosRepository")
 */
class Documentos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="documentos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombredocumento", type="string", length=255, nullable=false)
     */
    private $nombredocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrereferencial", type="string", length=255, nullable=false)
     */
    private $nombrereferencial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechasubida", type="datetime", nullable=false)
     */
    private $fechasubida;


    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



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
     * Set nombredocumento
     *
     * @param string $nombredocumento
     *
     * @return Documentos
     */
    public function setNombredocumento($nombredocumento)
    {
        $this->nombredocumento = $nombredocumento;

        return $this;
    }

    /**
     * Get nombredocumento
     *
     * @return string
     */
    public function getNombredocumento()
    {
        return $this->nombredocumento;
    }

    /**
     * Set nombrereferencial
     *
     * @param string $nombrereferencial
     *
     * @return Documentos
     */
    public function setNombrereferencial($nombrereferencial)
    {
        $this->nombrereferencial = $nombrereferencial;

        return $this;
    }

    /**
     * Get nombrereferencial
     *
     * @return string
     */
    public function getNombrereferencial()
    {
        return $this->nombrereferencial;
    }

    /**
     * Set fechasubida
     *
     * @param \DateTime $fechasubida
     *
     * @return Documentos
     */
    public function setFechasubida($fechasubida)
    {
        $this->fechasubida = $fechasubida;

        return $this;
    }

    /**
     * Get fechasubida
     *
     * @return \DateTime
     */
    public function getFechasubida()
    {
        return $this->fechasubida;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Documentos
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

}
