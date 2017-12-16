<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolesRepository")
 */
class Roles
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
     * @ORM\Column(name="Nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="DepartamentoProyecto", type="string", length=100)
     */
    private $departamentoProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=100)
     */
    private $descripcion;


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
     * @return Roles
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
     * Set departamentoProyecto
     *
     * @param string $departamentoProyecto
     *
     * @return Roles
     */
    public function setDepartamentoProyecto($departamentoProyecto)
    {
        $this->departamentoProyecto = $departamentoProyecto;

        return $this;
    }

    /**
     * Get departamentoProyecto
     *
     * @return string
     */
    public function getDepartamentoProyecto()
    {
        return $this->departamentoProyecto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Roles
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

