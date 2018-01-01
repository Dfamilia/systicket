<?php

namespace AppBundle\Controller;

use AppBundle\Form\CategoriaTicketType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CategoriaTicket;

/**
 * @Route("/categoria")
 */

//++++++++++++++++++++++++++++++++++++++++++//
/////////////////--VIEWS--////////////////////
//++++++++++++++++++++++++++++++++++++++++++//

class CategoriaController extends FOSRestController
{
    //------------- index ----------------//
    /**
     * @Route("", name="categoria", options={"expose" = true})
     * @Method("GET")
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {

        $categoriaBD = $this->getDoctrine()->getRepository('AppBundle:CategoriaTicket');
        $dCategoria = $categoriaBD->findAll();

        return $this->render('AppBundle:Categoria:categoria.html.twig', array("categoria"=>$dCategoria));

    }//indexAction


    //------------- nuevo ----------------//

    /**
     * @Route("/new", name="newCategoria", options={"expose"=true})
     * @Method("GET")
     * @return JsonResponse
     */
    public function newAction(){

        return $this->render('AppBundle:Categoria:newCategoria.html.twig');

    }//newAction


    //-------------- editar -----------------//
    /**
     * @Route("/{id}", name="editCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     * @param Request $request
     * @param CategoriaTicket $categoria
     * @return JsonResponse
     */
    public function editAction(Request $request, CategoriaTicket $categoria){

        $categoriaData = json_decode($this->get('serializer')->serialize($categoria, 'json'), true);

        return $this->render('AppBundle:Categoria:editCategoria.html.twig',array("categoriaW"=>$categoriaData));

    }//editAction


//++++++++++++++++++++++++++++++++++++++++++//
/////////////////--APIs--////////////////////
//++++++++++++++++++++++++++++++++++++++++++//

    //--------------- Crear --------------//
    /**
     * @Route("/new/", name="postCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function postAction(Request $request){

        $data = json_decode($request->getContent(), true);

        $categoria = new CategoriaTicket();

        $form = $this->createForm(CategoriaTicketType::class, $categoria);

        $form->submit($data);

        if ($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

        }else{

            foreach($form->getErrors() as $error){

                $error[] = $error->getMessage();

            }
        }

        $newCategoria = json_decode($this->get('serializer')->serialize($categoria, 'json'), true);

        return new JsonResponse($newCategoria);

    }//postAction

    //----------- Actualizar ----------------------//

    /**
     * @Route("/{id}/", name="updCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("PUT")
     * @param Request $request
     * @param CategoriaTicket $updCategoria
     * @return JsonResponse
     */
    public function updAction(Request $request, CategoriaTicket $updCategoria)
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(CategoriaTicketType::class, $updCategoria);

        $form->submit($data);

        if ($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->flush();

        }else{

            foreach ($form->getErrors() as $error){
                $errors[] = $error->getMessage();
            }
        }

        $updcategoria = json_decode($this->get('serializer')->serialize($updCategoria, 'json'), true);

        return new JsonResponse($updcategoria);
    }


    //----------- Borrar -----------------//
    /**
     * @Route("/{id}/", name="delCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @param CategoriaTicket $delCategoria
     * @return JsonResponse
     */
    public function delAction(CategoriaTicket $delCategoria){

        $em = $this->getDoctrine()->getManager();
        $em->remove($delCategoria);
        $em->flush();

        return $this->redirectToRoute('categoria');
    }



}//endClass
