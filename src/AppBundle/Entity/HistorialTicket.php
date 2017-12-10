<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistorialTicket
 *
 * @ORM\Table(name="historial_ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistorialTicketRepository")
 */
class HistorialTicket
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
     * @ORM\Column(name="FechaCreado", type="datetime")
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="text")
     */
    private $estado;


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
     * @return HistorialTicket
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
     * @return HistorialTicket
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
     * @return HistorialTicket
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
     * Set estado
     *
     * @param string $estado
     *
     * @return HistorialTicket
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
}

