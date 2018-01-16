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
     * @ORM\Column(name="nombres", type="string", length=85)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=170)
     */
    private $userLastname;

	/**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=25)
     */
    private $nickname;

	/**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=50)
     */
    private $password;

	/**
     * @var string
     *
     * @ORM\Column(name="tipousuario", type="string", length=50)
     */
    private $userType;

	/**
     * @var int
     *
     * @ORM\Column(name="rol", type="integer")
     */
    private $idRol;

	/**
     * @var string
     *
     * @ORM\Column(name="estadousuario", type="string", length=20)
     */
    private $userStatus;

	/**
     * @var \DateTime
     *
     * @ORM\Column(name="fecharegistrousuario", type="datetime")
     */
    private $userCreateDate;


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
     * Set userName
     *
     * @param string $userName
     *
     * @return Usuario
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userLastname
     *
     * @param string $userLastname
     *
     * @return Usuario
     */
    public function setUserLastname($userLastname)
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    /**
     * Get userLastname
     *
     * @return string
     */
    public function getUserLastname()
    {
        return $this->userLastname;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Usuario
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
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

    /**
     * Set userType
     *
     * @param string $userType
     *
     * @return Usuario
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set idRol
     *
     * @param integer $idRol
     *
     * @return Usuario
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Get idRol
     *
     * @return integer
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set userStatus
     *
     * @param string $userStatus
     *
     * @return Usuario
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return string
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set userCreateDate
     *
     * @param \DateTime $userCreateDate
     *
     * @return Usuario
     */
    public function setUserCreateDate($userCreateDate)
    {
        $this->userCreateDate = $userCreateDate;

        return $this;
    }

    /**
     * Get userCreateDate
     *
     * @return \DateTime
     */
    public function getUserCreateDate()
    {
        return $this->userCreateDate;
    }
}
