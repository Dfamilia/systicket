<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCategoria
 *
 * @ORM\Table(name="usuario_categoria")
 * @ORM\Entity
 */
class UsuarioCategoria
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
     * @ORM\Column(name="UsuarioID", type="integer", nullable=false)
     */
    private $usuarioid;

    /**
     * @var integer
     *
     * @ORM\Column(name="CategoriaID", type="integer", nullable=false)
     */
    private $categoriaid;


}

