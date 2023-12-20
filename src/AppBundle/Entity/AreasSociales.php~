<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Areassociales
 *
 * @ORM\Table(name="areassociales")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreassocialesRepository")
 */
class Areassociales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="areassociales_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreareasocial", type="string", length=255, nullable=false)
     */
    private $nombreareasocial;



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
     * Set nombreareasocial
     *
     * @param string $nombreareasocial
     *
     * @return Areassociales
     */
    public function setNombreareasocial($nombreareasocial)
    {
        $this->nombreareasocial = $nombreareasocial;

        return $this;
    }

    /**
     * Get nombreareasocial
     *
     * @return string
     */
    public function getNombreareasocial()
    {
        return $this->nombreareasocial;
    }
}
