<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
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

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido", type="string", length=100, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=100, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="UserPass", type="string", length=100, nullable=false)
     */
    private $userpass;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoUser", type="string", length=100, nullable=false)
     */
    private $tipouser;

    /**
     * @var integer
     *
     * @ORM\Column(name="RolID", type="integer", nullable=false)
     */
    private $rolid;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="FechaRegistro", type="string", length=20, nullable=false)
     */
    private $fecharegistro;


}

