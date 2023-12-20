<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Porcentajereservaanno
 *
 * @ORM\Table(name="porcentajereservaannos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PorcentajereservaannoRepository")
 */
class Porcentajereservaannos
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="anno", type="integer")
     */
    private $anno;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentajereserva", type="float")
     */
    private $porcentajereserva = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo = true;

    /**
     * Set anno
     *
     * @param integer $anno
     *
     * @return Porcentajereservaanno
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return int
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set porcentajereserva
     *
     * @param float $porcentajereserva
     *
     * @return Porcentajereservaanno
     */
    public function setPorcentajereserva($porcentajereserva)
    {
        $this->porcentajereserva = $porcentajereserva;

        return $this;
    }

    /**
     * Get porcentajereserva
     *
     * @return float
     */
    public function getPorcentajereserva()
    {
        return $this->porcentajereserva;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Porcentajereservaanno
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }
}

