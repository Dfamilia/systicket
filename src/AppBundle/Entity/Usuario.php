<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="text")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido", type="text")
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="text")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="UserPass", type="text")
     */
    private $userPass;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoUser", type="text")
     */
    private $tipoUser;

    /**
     * @var int
     *
     * @ORM\Column(name="RolID", type="integer")
     */
    private $rolID;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="text")
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaRegistro", type="datetime")
     */
    private $fechaRegistro;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
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
     * Set userPass
     *
     * @param string $userPass
     *
     * @return Usuario
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * Set tipoUser
     *
     * @param string $tipoUser
     *
     * @return Usuario
     */
    public function setTipoUser($tipoUser)
    {
        $this->tipoUser = $tipoUser;

        return $this;
    }

    /**
     * Get tipoUser
     *
     * @return string
     */
    public function getTipoUser()
    {
        return $this->tipoUser;
    }

    /**
     * Set rolID
     *
     * @param integer $rolID
     *
     * @return Usuario
     */
    public function setRolID($rolID)
    {
        $this->rolID = $rolID;

        return $this;
    }

    /**
     * Get rolID
     *
     * @return int
     */
    public function getRolID()
    {
        return $this->rolID;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Usuario
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
}
