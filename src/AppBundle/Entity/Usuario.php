<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Usuario
 *
 *  @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="akusername", columns={"username"})}, indexes={@ORM\Index(name="Ref2796", columns={"instancia_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 *
 */
class Usuario implements AdvancedUserInterface , \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isactive", type="boolean", nullable=false)
     */
    private $isactive = true;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoacceso", type="string", length=4, nullable=true)
     */
    private $codigoacceso;

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
     * @ORM\ManyToOne(targetEntity="Personas", inversedBy="usuarios")
     */
    private $persona;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="usuario_role",
     *     joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $usuario_roles;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->usuario_roles = new ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Usuario
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return boolean
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    // Inicio metodos para el mecanismo de seguridad
    public function setUsuarioRoles($roles)
    {
        $this->usuario_roles = $roles;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isactive;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isactive
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isactive
            ) = unserialize($serialized);
    }

    public function getRoles()
    {
        //IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array

        $roles = array();
        foreach ($this->usuario_roles as $role) {
            $roles[] = $role->getRole();
        }
        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    // Fin metodos para el mecanismo de seguridad

    /**
     * Add usuarioRole
     *
     * @param \AppBundle\Entity\Role $usuarioRole
     *
     * @return Usuario
     */
    public function addUsuarioRole(\AppBundle\Entity\Role $usuarioRole)
    {
        $this->usuario_roles[] = $usuarioRole;

        return $this;
    }

    /**
     * Remove usuarioRole
     *
     * @param \AppBundle\Entity\Role $usuarioRole
     */
    public function removeUsuarioRole(\AppBundle\Entity\Role $usuarioRole)
    {
        $this->usuario_roles->removeElement($usuarioRole);
    }

    /**
     * Get usuarioRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarioRoles()
    {
        return $this->usuario_roles;
    }

    /**
     * Set instancia
     *
     * @param \AppBundle\Entity\Instancias $instancia
     *
     * @return Usuario
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
     * Set codigoacceso
     *
     * @param string $codigoacceso
     *
     * @return Usuario
     */
    public function setCodigoacceso($codigoacceso)
    {
        $this->codigoacceso = $codigoacceso;

        return $this;
    }

    /**
     * Get codigoacceso
     *
     * @return string
     */
    public function getCodigoacceso()
    {
        return $this->codigoacceso;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Personas $persona
     *
     * @return Usuario
     */
    public function setPersona(\AppBundle\Entity\Personas $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Personas
     */
    public function getPersona()
    {
        return $this->persona;
    }

}
