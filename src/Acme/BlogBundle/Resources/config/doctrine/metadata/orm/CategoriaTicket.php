<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaTicket
 *
 * @ORM\Table(name="categoria_ticket")
 * @ORM\Entity
 */
class CategoriaTicket
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
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=100, nullable=false)
     */
    private $nombre;


}

