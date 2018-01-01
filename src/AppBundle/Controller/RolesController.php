<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Roles;
use AppBundle\Form\RolesType;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;


/**
 * @Route("/roles")
 */

class RolesController extends FOSRestController
{

    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================ index ==================//
    /**
     * @Route("", name="rolesIndex", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $RolesBD = $this->getDoctrine()->getRepository('AppBundle:Roles');
        $rolesWaiter = $RolesBD->findAll();

        return $this->render('AppBundle:Roles:roles.html.twig', array("rolesWaiter"=>$rolesWaiter));
    }


    //================== nuevo =================//

    /**
     * @Route("/new", name="newRol", options={"expose"=true})
     * @Method("GET")
     */
    public function newAction()
    {
        return $this->render('AppBundle:Roles:newRol.html.twig');
    }

    //================= editar =================//

    /**
     * @Route("/{id}", name="editRol", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     * @param Request $request
     * @param Roles $rol
     */
    public function editAction(Request $request, Roles $rol)
    {
        $data = json_decode($this->get('serializer')->serialize($rol, 'json'),true);

        return $this->render('AppBundle:Roles:editRol.html.twig',array('editRol'=>$data));

    }



    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================= Add(guardar) ================//

    /**
     * @Route("/new/", name="addRol", options={"expose"=true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $food = json_decode($request->getContent(), true);

        $newOrder = new Roles();

        $orderForm = $this->createForm(RolesType::class, $newOrder);

        $orderForm->submit($food);


        if ($orderForm->isValid()){

            $waiter = $this->getDoctrine()->getManager();

            $waiter->persist($newOrder);
            $waiter->flush();

        }else{
            //dump('invalid');
        }

        $newRole = json_decode($this->get('serializer')->serialize($newOrder, 'json'), true);

        return new JsonResponse($newRole);
       // return $this->redirectToRoute('rolesIndex');

    }

    //================= Upd(actualizar) =============//

    /**
     * @Route("/{id}/", name="updRol", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("PUT")
     * @param Request $request
     * @param Roles $rol
     * @return JsonResponse
     */
    public function updAction(Request $request, Roles $rol){

        $food = json_decode($request->getContent(), true);

        $updForm = $this->createForm(RolesType::class, $rol);

        $updForm->submit($food);

        if ($updForm->isValid()){

            $waiter = $this->getDoctrine()->getManager();
            $waiter->flush();

        }else{
            dump('error al actualizar');
        }

        $updrol = json_decode($this->get('serializer')->serialize($rol, 'json'), true);
        return new JsonResponse($updrol);
    }


    //================= Del(borrar) =================//
    /**
     * @Route("/{id}/", name="delRoles", requirements={"id"="\d+"},options={"expose"=true})
     * @param Roles $rol
     * @Method("GET")
     */
    public function delAction(Roles $rol)
    {
       $rolWaiter = $this->getDoctrine()->getManager();
       $rolWaiter->remove($rol);
       $rolWaiter->flush();

       return $this->redirectToRoute('rolesIndex');
    }
}
