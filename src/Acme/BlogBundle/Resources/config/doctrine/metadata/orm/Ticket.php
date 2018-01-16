<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity
 */
class Ticket
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
     * @ORM\Column(name="FechaCreado", type="string", length=20, nullable=false)
     */
    private $fechacreado;

    /**
     * @var string
     *
     * @ORM\Column(name="FechaStatus", type="string", length=20, nullable=false)
     */
    private $fechastatus;

    /**
     * @var string
     *
     * @ORM\Column(name="FechaCierre", type="string", length=20, nullable=false)
     */
    private $fechacierre;

    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionProblema", type="string", length=100, nullable=false)
     */
    private $descripcionproblema;

    /**
     * @var string
     *
     * @ORM\Column(name="Categoria", type="string", length=100, nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="Prioridad", type="string", length=100, nullable=false)
     */
    private $prioridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="UsuarioSolicitanteID", type="integer", nullable=false)
     */
    private $usuariosolicitanteid;

    /**
     * @var integer
     *
     * @ORM\Column(name="UsuarioAsignadoID", type="integer", nullable=false)
     */
    private $usuarioasignadoid;

    /**
     * @var string
     *
     * @ORM\Column(name="Titulo", type="string", length=100, nullable=false)
     */
    private $titulo;


}

