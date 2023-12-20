<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametros
 *
 * @ORM\Table(name="parametros")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametrosRepository")
 */
class Parametros
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="parametros_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreparametro", type="string", length=255, nullable=false)
     */
    private $nombreparametro;



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
     * Set nombreparametro
     *
     * @param string $nombreparametro
     *
     * @return Parametros
     */
    public function setNombreparametro($nombreparametro)
    {
        $this->nombreparametro = $nombreparametro;

        return $this;
    }

    /**
     * Get nombreparametro
     *
     * @return string
     */
    public function getNombreparametro()
    {
        return $this->nombreparametro;
    }
}
