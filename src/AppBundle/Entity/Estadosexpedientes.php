<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadosexpedientes
 *
 * @ORM\Table(name="estadosexpedientes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadosexpedientesRepository")
 */
class Estadosexpedientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="estadosexpedientes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreestado", type="string", length=255, nullable=false)
     */
    private $nombreestado;



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
     * Set nombreestado
     *
     * @param string $nombreestado
     *
     * @return Estadosexpedientes
     */
    public function setNombreestado($nombreestado)
    {
        $this->nombreestado = $nombreestado;

        return $this;
    }

    /**
     * Get nombreestado
     *
     * @return string
     */
    public function getNombreestado()
    {
        return $this->nombreestado;
    }
}
