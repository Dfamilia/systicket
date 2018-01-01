<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * HistorialTicket
 *
 * @ORM\Table(name="historial_ticket")
 * @ORM\Entity
 */
class HistorialTicket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="TicketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var integer
     *
     * @ORM\Column(name="UsuarioID", type="integer", nullable=false)
     */
    private $usuarioid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaCreado", type="datetime", nullable=false)
     */
    private $fechacreado;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=100, nullable=false)
     */
    private $estado;


}

