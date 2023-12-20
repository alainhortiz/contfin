<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Secciones
 *
 * @ORM\Table(name="secciones", indexes={@ORM\Index(name="Ref4987", columns={"ministropersona_id"}), @ORM\Index(name="Ref4988", columns={"contactopersona_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeccionesRepository")
 */
class Secciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="secciones_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoseccion", type="string", length=10, nullable=false)
     */
    private $codigoseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreseccion", type="string", length=255, nullable=false)
     */
    private $nombreseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono1", type="string", length=50, nullable=true)
     */
    private $telefono1;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono2", type="string", length=50, nullable=true)
     */
    private $telefono2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confidencial", type="boolean", nullable=false)
     */
    private $confidencial = false;

    /**
     * @var \Personas
     *
     * @ORM\ManyToOne(targetEntity="Personas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ministropersona_id", referencedColumnName="id")
     * })
     */
    private $ministropersona;

    /**
     * @var \Personas
     *
     * @ORM\ManyToOne(targetEntity="Personas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contactopersona_id", referencedColumnName="id")
     * })
     */
    private $contactopersona;

    /**
     * @var \Areassociales
     *
     * @ORM\ManyToOne(targetEntity="Areassociales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="areasocial_id", referencedColumnName="id")
     * })
     */
    private $areasocial;

    /**
     * @ORM\OneToMany(targetEntity="Servicios", mappedBy="seccion")
     */
    private $servicios;

    /**
     * Servicios constructor.
     */
    public function __construct()
    {
        $this->servicios = new ArrayCollection();
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
     * Set codigoseccion
     *
     * @param string $codigoseccion
     *
     * @return Secciones
     */
    public function setCodigoseccion($codigoseccion)
    {
        $this->codigoseccion = $codigoseccion;

        return $this;
    }

    /**
     * Get codigoseccion
     *
     * @return string
     */
    public function getCodigoseccion()
    {
        return $this->codigoseccion;
    }

    /**
     * Set nombreseccion
     *
     * @param string $nombreseccion
     *
     * @return Secciones
     */
    public function setNombreseccion($nombreseccion)
    {
        $this->nombreseccion = $nombreseccion;

        return $this;
    }

    /**
     * Get nombreseccion
     *
     * @return string
     */
    public function getNombreseccion()
    {
        return $this->nombreseccion;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Secciones
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono1
     *
     * @param string $telefono1
     *
     * @return Secciones
     */
    public function setTelefono1($telefono1)
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    /**
     * Get telefono1
     *
     * @return string
     */
    public function getTelefono1()
    {
        return $this->telefono1;
    }

    /**
     * Set telefono2
     *
     * @param string $telefono2
     *
     * @return Secciones
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    /**
     * Get telefono2
     *
     * @return string
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }

    /**
     * Set ministropersona
     *
     * @param \AppBundle\Entity\Personas $ministropersona
     *
     * @return Secciones
     */
    public function setMinistropersona(\AppBundle\Entity\Personas $ministropersona = null)
    {
        $this->ministropersona = $ministropersona;

        return $this;
    }

    /**
     * Get ministropersona
     *
     * @return \AppBundle\Entity\Personas
     */
    public function getMinistropersona()
    {
        return $this->ministropersona;
    }

    /**
     * Set contactopersona
     *
     * @param \AppBundle\Entity\Personas $contactopersona
     *
     * @return Secciones
     */
    public function setContactopersona(\AppBundle\Entity\Personas $contactopersona = null)
    {
        $this->contactopersona = $contactopersona;

        return $this;
    }

    /**
     * Get contactopersona
     *
     * @return \AppBundle\Entity\Personas
     */
    public function getContactopersona()
    {
        return $this->contactopersona;
    }

    /**
     * Add servicio
     *
     * @param \AppBundle\Entity\Servicios $servicio
     *
     * @return Secciones
     */
    public function addServicio(\AppBundle\Entity\Servicios $servicio)
    {
        $this->servicios[] = $servicio;

        return $this;
    }

    /**
     * Remove servicio
     *
     * @param \AppBundle\Entity\Servicios $servicio
     */
    public function removeServicio(\AppBundle\Entity\Servicios $servicio)
    {
        $this->servicios->removeElement($servicio);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Set confidencial
     *
     * @param boolean $confidencial
     *
     * @return Secciones
     */
    public function setConfidencial($confidencial)
    {
        $this->confidencial = $confidencial;

        return $this;
    }

    /**
     * Get confidencial
     *
     * @return boolean
     */
    public function getConfidencial()
    {
        return $this->confidencial;
    }

    /**
     * Set areasocial
     *
     * @param \AppBundle\Entity\Areassociales $areasocial
     *
     * @return Secciones
     */
    public function setAreasocial(\AppBundle\Entity\Areassociales $areasocial = null)
    {
        $this->areasocial = $areasocial;

        return $this;
    }

    /**
     * Get areasocial
     *
     * @return \AppBundle\Entity\Areassociales
     */
    public function getAreasocial()
    {
        return $this->areasocial;
    }
}
