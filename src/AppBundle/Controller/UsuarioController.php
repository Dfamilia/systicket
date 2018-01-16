<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\HttpFoundation\JsonResponse;


    //----- Ruta General------//
    /**
     * @Route("/usuario")
     */

class UsuarioController extends FOSRestController

{
    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//


    // =============== Index ================== //
    /**
     * @Route("/", name="indexUsuario", options={"expose" = true})
     * @Method("GET")
     */
    public function indexAction()
    {
        $usuarioRol = array();

        // Array de arreglos de datos usuario["id"], rol["nombre"]

        $datosUsuarioBD = $this->getDoctrine()->getRepository('AppBundle:Usuario');

        $datosRolesBD = $this->getDoctrine()->getRepository('AppBundle:Roles');

        //script que busca y crea un array concatenando usuario.id con rol.nombre
        $usuarioList = $datosUsuarioBD->findAll();

        if (!empty($usuarioList)) {

            foreach ($usuarioList as $usuario) {

                $id = $usuario->getRolID();

                $datosRol = $datosRolesBD->find($id);

                if (!empty($datosRol)) {

                    $nombreRol = $datosRol->getNombre();

                    $usuarioRol[] = ["id" => "$id", "nombre" => "$nombreRol"];

                }else{
                       $usuarioRol[] = ["id" => 0, "nombre" => "none"];
                }


            }
        }

        return $this->render('AppBundle:Usuario:indexUsuario.html.twig',array("usuarioList"=>$usuarioList, "usuarioRol"=>$usuarioRol));
    }

    // ================ Nuevo ================== //

    /**
     * @Route("/new", name="newUsuario", options={"expose" = true})
     * @Method("GET")
     */
    public function newAction()
    {

        $rolDataBD = $this->getDoctrine()->getRepository('AppBundle:Roles');

        $rolOptions = $rolDataBD->findAll();

        return $this->render('AppBundle:Usuario:newUsuario.html.twig',array("rolOptions"=>$rolOptions));
    }


    // =================== Edit ================= //

    /**
     * @Route("/{id}", name="editUsuario", options={"expose" = true}, requirements={"id"="\d+"})
     * @Method("GET")
     * @param Usuario $usuario
     */
    public function editAction(Usuario $usuario)
    {
        $data = json_decode($this->get('serializer')->serialize($usuario, 'json'), true);

        $rolDataBD = $this->getDoctrine()->getRepository('AppBundle:Roles');

        $rolOptions = $rolDataBD->findAll();

        //script para el nombre del rol default del view editusuario

        $roloptionID = $rolDataBD->find($data["rolID"]);

        if (!empty($roloptionID))
        {
            $rolid = $roloptionID->getId();
            $rolnombre = $roloptionID->getNombre();
            $rolDefault = ["id"=>$rolid,"nombre"=>$rolnombre];
        }else{
            $rolDefault = ["id"=>0,"nombre"=>'none'];

        }


        return $this->render('AppBundle:Usuario:editUsuario.html.twig', array("usuario"=>$data,"rolOptions"=>$rolOptions,"rolDefault"=>$rolDefault));
    }



    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//



    // ================= Add ================== //
    /**
     * @Route("/new/", name="addUsuario", options={"expose" = true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request){

        //obtener datos json del objeto request //
        $data = json_decode($request->getContent(), true);

        //crear un objeto de la clase Entity:Usuario//
        $usuario = new Usuario();

        //crear objeto de la clase Form:UsuarioType//
        $form = $this->createForm(UsuarioType::Class, $usuario);

        //finaliza y envia datos despues del debugeo interno de symfony
        $form->submit($data);


        //le cambio el formato al date time para que retorne un string y despues insertarlo
        $date = new \DateTime();
        $date = $date->format("M/d/Y H:m a");


        //inserta dato extra fuera de la validacion de symfony///
        $usuario->setFechaRegistro($date);

        //preguntamos si es valido el formulario con el proceso de validacion de symfony
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            //dump("is Valid");

        }else{
            foreach ($form->getErrors() as $error)
            {
                $error[] = $error->getMessage();
            }
        }

        $newUsuario = json_decode($this->get('serializer')->serialize($usuario,'json'), true);

        return new JsonResponse($newUsuario);

    }


    // ================== Update ================= //

    /**
     * @Route("/{id}/", name="updUsuario", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("PUT")
     * @param Request $request
     * @param Usuario $updusuario
     * @return JsonResponse
     */
    public function updAction(Request $request, Usuario $updusuario)
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(UsuarioType::class, $updusuario);

        //le cambio el formato al date time para que retorne un string y despues insertarlo
        $date = new \DateTime();
        $date = $date->format("M/d/Y H:m a");


        //inserta dato extra fuera de la validacion de symfony///
        $updusuario->setFechaRegistro($date);

        $form->submit($data);

        if ($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->flush();

        }else{

            foreach ($form->getErrors() as $error){
                $errors[] = $error->getMessage();
            }
        }

        $updusuario = json_decode($this->get('serializer')->serialize($updusuario, 'json'), true);

        return new JsonResponse($updusuario);
    }

    // =================== Delete ===================== //

    /**
     * @Route("/{id}/", name="delUsuario", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("DELETE")
     * @param Usuario $delusuario
     * @return JsonResponse
     */
    public function delAction(Usuario $delusuario){

       // $data = json_encode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $em->remove($delusuario);
        $em->flush();

        $delUsuario = json_decode($this->get('serializer')->serialize($delusuario, 'json'), true);

        return new JsonResponse($delusuario);
    }


}
