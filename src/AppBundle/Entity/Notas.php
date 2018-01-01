<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notas
 *
 * @ORM\Table(name="notas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotasRepository")
 */
class Notas
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
     * @ORM\Column(name="TicketID", type="integer")
     */
    private $ticketID;

    /**
     * @var int
     *
     * @ORM\Column(name="UsuarioID", type="integer")
     */
    private $usuarioID;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaCreado", type="string", length=100)
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionNota", type="string", length=100)
     */
    private $descripcionNota;


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
     * Set ticketID
     *
     * @param integer $ticketID
     *
     * @return Notas
     */
    public function setTicketID($ticketID)
    {
        $this->ticketID = $ticketID;

        return $this;
    }

    /**
     * Get ticketID
     *
     * @return int
     */
    public function getTicketID()
    {
        return $this->ticketID;
    }

    /**
     * Set usuarioID
     *
     * @param integer $usuarioID
     *
     * @return Notas
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
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     *
     * @return Notas
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return \DateTime
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set descripcionNota
     *
     * @param string $descripcionNota
     *
     * @return Notas
     */
    public function setDescripcionNota($descripcionNota)
    {
        $this->descripcionNota = $descripcionNota;

        return $this;
    }

    /**
     * Get descripcionNota
     *
     * @return string
     */
    public function getDescripcionNota()
    {
        return $this->descripcionNota;
    }
}

