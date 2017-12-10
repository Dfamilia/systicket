<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCategoria
 *
 * @ORM\Table(name="usuario_categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioCategoriaRepository")
 */
class UsuarioCategoria
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
     * @var int
     *
     * @ORM\Column(name="UsuarioID", type="integer")
     */
    private $usuarioID;

    /**
     * @var int
     *
     * @ORM\Column(name="CategoriaID", type="integer")
     */
    private $categoriaID;


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
     * Set usuarioID
     *
     * @param integer $usuarioID
     *
     * @return UsuarioCategoria
     */
    public function setUsuarioID($usuarioID)
    {
        $this->usuarioID = $usuarioID;

        return $this;
    }

    /**
     * Get usuarioID
     *
     * @return int
     */
    public function getUsuarioID()
    {
        return $this->usuarioID;
    }

    /**
     * Set categoriaID
     *
     * @param integer $categoriaID
     *
     * @return UsuarioCategoria
     */
    public function setCategoriaID($categoriaID)
    {
        $this->categoriaID = $categoriaID;

        return $this;
    }

    /**
     * Get categoriaID
     *
     * @return int
     */
    public function getCategoriaID()
    {
        return $this->categoriaID;
    }
}

