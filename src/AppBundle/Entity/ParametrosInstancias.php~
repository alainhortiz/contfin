<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametrosinstancias
 *
 * @ORM\Table(name="parametrosinstancias", indexes={@ORM\Index(name="Ref2836", columns={"parametro_id"}), @ORM\Index(name="Ref2737", columns={"instancia_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametrosinstanciasRepository")
 */
class Parametrosinstancias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="parametrosinstancias_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Parametros
     *
     * @ORM\ManyToOne(targetEntity="Parametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parametro_id", referencedColumnName="id")
     * })
     */
    private $parametro;

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
     * Set parametro
     *
     * @param \AppBundle\Entity\Parametros $parametro
     *
     * @return Parametrosinstancias
     */
    public function setParametro(\AppBundle\Entity\Parametros $parametro = null)
    {
        $this->parametro = $parametro;

        return $this;
    }

    /**
     * Get parametro
     *
     * @return \AppBundle\Entity\Parametros
     */
    public function getParametro()
    {
        return $this->parametro;
    }

    /**
     * Set instancia
     *
     * @param \AppBundle\Entity\Instancias $instancia
     *
     * @return Parametrosinstancias
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
