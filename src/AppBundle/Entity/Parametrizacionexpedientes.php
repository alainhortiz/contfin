<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Parametrizacionexpedientes
 *
 * @ORM\Table(name="parametrizacionexpedientes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametrizacionexpedientesRepository")
 */
class Parametrizacionexpedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="parametrizacionexpedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Expedientes" , inversedBy="parametrizaciones")
     */
    private $expediente;

    /**
     * @ORM\ManyToOne(targetEntity="Instancias" , inversedBy="parametrizaciones")
     */
    private $instancia;

    /**
     * @ORM\ManyToOne(targetEntity="Evidenciasexpedientes" , inversedBy="parametrizaciones")
     */
    private $evidenciaexpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="montoapagar", type="decimal", precision=18, scale=3, nullable=true)
     */
    private $montoapagar;

    /**
     * @ORM\ManyToMany(targetEntity="Parametrosinstancias")
     * @ORM\JoinTable(name="parametrosinstanciasexpedientes",
     *     joinColumns={@ORM\JoinColumn(name="parametrizacionexpediente_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="parametroinstancia_id", referencedColumnName="id")}
     * )
     */
    private $parametros;

    /**
     * Parametrizacionexpedientes constructor.
     */
    public function __construct()
    {
        $this->parametros = new ArrayCollection();
    }


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
     * Set expediente
     *
     * @param \AppBundle\Entity\Expedientes $expediente
     *
     * @return Parametrizacionexpedientes
     */
    public function setExpediente(\AppBundle\Entity\Expedientes $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente
     *
     * @return \AppBundle\Entity\Expedientes
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set instancia
     *
     * @param \AppBundle\Entity\Instancias $instancia
     *
     * @return Parametrizacionexpedientes
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

    /**
     * Set evidenciaexpediente
     *
     * @param \AppBundle\Entity\Evidenciasexpedientes $evidenciaexpediente
     *
     * @return Parametrizacionexpedientes
     */
    public function setEvidenciaexpediente(\AppBundle\Entity\Evidenciasexpedientes $evidenciaexpediente = null)
    {
        $this->evidenciaexpediente = $evidenciaexpediente;

        return $this;
    }

    /**
     * Get evidenciaexpediente
     *
     * @return \AppBundle\Entity\Evidenciasexpedientes
     */
    public function getEvidenciaexpediente()
    {
        return $this->evidenciaexpediente;
    }


    /**
     * Add parametro
     *
     * @param \AppBundle\Entity\Parametrosinstancias $parametro
     *
     * @return Parametrizacionexpedientes
     */
    public function addParametro(\AppBundle\Entity\Parametrosinstancias $parametro)
    {
        $this->parametros[] = $parametro;

        return $this;
    }

    /**
     * Remove parametro
     *
     * @param \AppBundle\Entity\Parametrosinstancias $parametro
     */
    public function removeParametro(\AppBundle\Entity\Parametrosinstancias $parametro)
    {
        $this->parametros->removeElement($parametro);
    }

    /**
     * Get parametros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    public function setParametrosInstancias($parametrosInstancias)
    {
        $this->parametros = $parametrosInstancias;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Parametrizacionexpedientes
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set montoapagar
     *
     * @param string $montoapagar
     *
     * @return Parametrizacionexpedientes
     */
    public function setMontoapagar($montoapagar)
    {
        $this->montoapagar = $montoapagar;

        return $this;
    }

    /**
     * Get montoapagar
     *
     * @return string
     */
    public function getMontoapagar()
    {
        return $this->montoapagar;
    }
}
