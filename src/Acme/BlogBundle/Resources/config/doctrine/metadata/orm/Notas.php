<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Notas
 *
 * @ORM\Table(name="notas")
 * @ORM\Entity
 */
class Notas
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
     * @var string
     *
     * @ORM\Column(name="FechaCreado", type="string", length=100, nullable=false)
     */
    private $fechacreado;

    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionNota", type="string", length=100, nullable=false)
     */
    private $descripcionnota;


}

