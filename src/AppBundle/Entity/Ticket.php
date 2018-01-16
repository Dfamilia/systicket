<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @ORM\Column(name="FechaCreado", type="string", length=100)
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="FechaStatus", type="string", length=100)
     */
    private $fechaStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="FechaCierre", type="string", length=100)
     */
    private $fechaCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionProblema", type="string", length=100)
     */
    private $descripcionProblema;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=100)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="Prioridad", type="string", length=100)
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="Categoria", type="string", length=100)
     */
    private $categoria;

    /**
     * @var int
     *
     * @ORM\Column(name="UsuarioSolicitanteID", type="integer")
     */
    private $usuarioSolicitanteID;

    /**
     * @var int
     *
     * @ORM\Column(name="UsuarioAsignadoID", type="integer")
     */
    private $usuarioAsignadoID;

    /**
     * @var string
     *
     * @ORM\Column(name="Titulo", type="string", length=100)
     */
    private $titulo;


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
     * Set fechaCreado
     *
     * @param string $fechaCreado
     *
     * @return Ticket
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return string
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set fechaStatus
     *
     * @param string $fechaStatus
     *
     * @return Ticket
     */
    public function setFechaStatus($fechaStatus)
    {
        $this->fechaStatus = $fechaStatus;

        return $this;
    }

    /**
     * Get fechaStatus
     *
     * @return string
     */
    public function getFechaStatus()
    {
        return $this->fechaStatus;
    }

    /**
     * Set fechaCierre
     *
     * @param string $fechaCierre
     *
     * @return Ticket
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return string
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set descripcionProblema
     *
     * @param string $descripcionProblema
     *
     * @return Ticket
     */
    public function setDescripcionProblema($descripcionProblema)
    {
        $this->descripcionProblema = $descripcionProblema;

        return $this;
    }

    /**
     * Get descripcionProblema
     *
     * @return string
     */
    public function getDescripcionProblema()
    {
        return $this->descripcionProblema;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Ticket
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
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return Ticket
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Ticket
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set usuarioSolicitanteID
     *
     * @param integer $usuarioSolicitanteID
     *
     * @return Ticket
     */
    public function setUsuarioSolicitanteID($usuarioSolicitanteID)
    {
        $this->usuarioSolicitanteID = $usuarioSolicitanteID;

        return $this;
    }

    /**
     * Get usuarioSolicitanteID
     *
     * @return int
     */
    public function getUsuarioSolicitanteID()
    {
        return $this->usuarioSolicitanteID;
    }

    /**
     * Set usuarioAsignadoID
     *
     * @param integer $usuarioAsignadoID
     *
     * @return Ticket
     */
    public function setUsuarioAsignadoID($usuarioAsignadoID)
    {
        $this->usuarioAsignadoID = $usuarioAsignadoID;

        return $this;
    }

    /**
     * Get usuarioAsignadoID
     *
     * @return int
     */
    public function getUsuarioAsignadoID()
    {
        return $this->usuarioAsignadoID;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Ticket
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
}

