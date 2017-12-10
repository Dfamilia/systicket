<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;

    //----- Ruta General------//
    /**
     * @Route("/usuario")
     */

class UsuarioController extends Controller

{
    //------Ruta del index de usuario-----------//
    /**
     * @Route("", name="usuario", options={"expose" = true})
     */
    public function indexAction(Request $request)
    {
    // replace this example code with whatever you need
         return $this->render('AppBundle:Usuario:usuario.html.twig');
    }

    //-----------Ruta del index de nuevo usuario-------------//
    /**
     * @Route("/nuevo", name="nuevousuario", options={"expose" = true})
     */
    public function nuevoUsuarioAction(Request $request)
    {
        // replace this example code with whatever you need
       // $usuarioEntity = new Usuario();
        $form = $this->createForm(UsuarioType::class);

        return $this->render('AppBundle:Usuario:nuevousuario.html.twig',array("usuarioForm"=>$form->createView() ));
    }

    //---------Ruta para guardar datos del nuevo usuario//
    /**
     * @Route("/post", name="guardar_usuario", options={"expose" = true})
     * @param Request $request
     * @Method({"POST"});
     *
     * @return JsonResponse
     */
    public function postUsuario(Request $request){
        dump($request);
        //obtener datos del objeto request //
        $data = json_decode($request->getContent(), true);
        dump($data);
        die;

        //crear un objeto de la clase Entity:Usuario//
        $usuario = new Usuario();
        //crear objeto de la clase Form:UsuarioType//
        $form = $this->createForm(UsuarioType::Class, $usuario);
        //finaliza y envia datos despues del debugeo interno de symfony
        $form->submit($data);
        //inserta dato extra dentro de la lista para esto aggregamos en form dos lineas extra para habilitar esta accion///
        $usuario->setFechaRegistro(new \DateTime());

        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);

            $em->flush();

        }

        $newUsuario = json_decode($this->get('serializer')->serialize($usuario,'json'), true);
        
        return new JsonResponse($newUsuario);

    }
}
