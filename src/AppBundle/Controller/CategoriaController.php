<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CategoriaTicket;
use AppBundle\Form\CategoriaTicketType;
/**
 * @Route("/categoria")
 */

//++++++++++++++++++++++++++++++++++++++++++//
/////////////////--VIEWS--////////////////////
//++++++++++++++++++++++++++++++++++++++++++//

class CategoriaController extends FOSRestController
{
    //================ Index =============//
    /**
     * @Route("/", name="indexCategoria", options={"expose" = true})
     * @Method("GET")
     */
    public function indexAction()
    {

        $categoriaBD = $this->getDoctrine()->getRepository('AppBundle:CategoriaTicket');
        $dCategoria = $categoriaBD->findAll();

        return $this->render('AppBundle:Categoria:indexCategoria.html.twig', array("categoria"=>$dCategoria));

    }//indexAction


    //============== New ===================//

    /**
     * @Route("/new", name="newCategoria", options={"expose"=true})
     * @Method("GET")
     */
    public function newAction(){

        return $this->render('AppBundle:Categoria:newCategoria.html.twig');

    }//newAction


    //================ Edit ===================//
    /**
     * @Route("/{id}", name="editCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     * @param CategoriaTicket $categoria
     */
    public function editAction(CategoriaTicket $categoria){

        $categoriaData = json_decode($this->get('serializer')->serialize($categoria, 'json'), true);

        return $this->render('AppBundle:Categoria:editCategoria.html.twig',array("categoriaW"=>$categoriaData));

    }//editAction


//++++++++++++++++++++++++++++++++++++++++++//
/////////////////--APIs--////////////////////
//++++++++++++++++++++++++++++++++++++++++++//

    //============= Add ===================//
    /**
     * @Route("/new/", name="addCategoria", options={"expose"=true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request){

        $data = json_decode($request->getContent(), true);

        $categoria = new CategoriaTicket;

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

        $newCategoria = json_decode($this->get('serializer')->serialize($categoria,'json'), true);
        dump($newCategoria);

        return new JsonResponse($newCategoria);

    }

    //=============== Update ======================//

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


    //================ Delete ==================//
    /**
     * @Route("/{id}/", name="delCategoria", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("DELETE")
     * @param CategoriaTicket $delCategoria
     * @return JsonResponse
     */
    public function delAction(CategoriaTicket $delCategoria){

        $em = $this->getDoctrine()->getManager();
        $em->remove($delCategoria);
        $em->flush();

        $delcategoria = json_decode($this->get('serializer')->serialize($delCategoria, 'json'), true);
        return new JsonResponse($delcategoria);
    }



}//endClass
