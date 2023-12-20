<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Personas;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use AppBundle\Entity\Usuario;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends \Doctrine\ORM\EntityRepository
{
    public function cambiarPassword($username , $passNew)
    {
        try
        {
            $em = $this->getEntityManager();
            $user = $em->getRepository('AppBundle:Usuario')->findOneBy(array('username' => $username));
            $encoder = new BCryptPasswordEncoder(12);
            $passNew = $encoder->encodePassword($passNew , null);
            $user->setPassword($passNew);

            $em->persist($user);
            $em->flush();
            $msg = $user;

        }catch (\Exception $e){

            $msg = 'Se produjo un error al cambiar la contraseña';

        }
        return $msg;

    }

    public function agregarUsuario($data)
    {
        try{
            $em = $this->getEntityManager();

            $persona = new Personas();
            $persona->setNombres($data['nombre']);
            $persona->setApellido1($data['primerApellido']);
            $persona->setApellido2($data['segundoApellido']);
            $persona->setEmail($data['email']);
            $persona->setTelefono1($data['telefono']);
            $em->persist($persona);

            $user = new Usuario();
            $user->setUsername($data['username']);

            $instancia = $em->getRepository('AppBundle:Instancias')->find($data['instancia']);
            $user->setInstancia($instancia);

            $encoder = new BCryptPasswordEncoder(12);
            $encoded = $encoder->encodePassword($data['username'],null);
            $user->setPassword($encoded);

            $usuarioRoles = new ArrayCollection();

            foreach( $data['roles'] as $role)
            {
                $usuarioRoles[] = $em->getRepository('AppBundle:Role')->find($role);
            }
            $user->setUsuarioRoles($usuarioRoles);

            $user->setPersona($persona);

            $em->persist($user);
            $em->flush();
            $msg = $user;

        }catch (\Exception $e)
        {
            if(strpos($e->getMessage() , 'Unique violation') > 0)
            {
                $msg = 'El Usuario ya existe , no se puede agregar';
            }
            else
            {
                $msg = 'Se produjo un error al agregar el usuario';
            }
        }
        return $msg;
    }

    public function eliminarUsuario($id)
    {
        try
        {
            $em = $this->getEntityManager();

            $user = $em->getRepository('AppBundle:Usuario')->find($id);

            $em->remove($user);
            $em->flush();
            $msg = $user;


        }catch (\Exception $e){

            if(strpos($e->getMessage() , 'Foreign key') > 0)
            {
                $msg = 'desactivar';
            }
            else
            {
                $msg = 'Se produjo un error al eliminar el usuario';
            }

        }
        return $msg;
    }

    public function desactivarrUsuario($id)
    {
        try
        {
            $em = $this->getEntityManager();

            $user = $em->getRepository('AppBundle:Usuario')->find($id);
            $user->setIsactive(false);

            $em->persist($user);
            $em->flush();
            $msg = $user;


        }catch (\Exception $e){

            $msg = 'Se produjo un error al eliminar el usuario';

        }
        return $msg;
    }

    public function modificarUsuario($data)
    {
        try
        {
            $em = $this->getEntityManager();
            $user = $em->getRepository('AppBundle:Usuario')->find($data['idUsuario']);

            $persona = $em->getRepository('AppBundle:Personas')->find($user->getPersona()->getId());
            $persona->setNombres($data['nombre']);
            $persona->setApellido1($data['primerApellido']);
            $persona->setApellido2($data['segundoApellido']);
            $persona->setEmail($data['email']);
            $persona->setTelefono1($data['telefono']);
            $em->persist($persona);

            $user->setUsername($data['username']);

            $instancia = $em->getRepository('AppBundle:Instancias')->find($data['instancia']);
            $user->setInstancia($instancia);

            $usuarioRoles = new ArrayCollection();

            foreach( $data['roles'] as $role)
            {
                $usuarioRoles[] = $em->getRepository('AppBundle:Role')->findOneBy(array('nombre' => $role));
            }
            $user->setUsuarioRoles($usuarioRoles);

            $user->setPersona($persona);

            $em->persist($user);
            $em->flush();
            $msg = $user;

        }catch (\Exception $e)
        {
            $msg = 'Se produjo un error al modificar el Usuario';
        }

        return $msg;
    }
}
