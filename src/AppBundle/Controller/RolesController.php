<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Roles;
use AppBundle\Form\RolesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/roles")
 */

class RolesController extends Controller
{

    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================ index ==================//
    /**
     * @Route("/", name="indexRoles", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $RolesBD = $this->getDoctrine()->getRepository('AppBundle:Roles');
        $rolesWaiter = $RolesBD->findAll();

        return $this->render('AppBundle:Roles:indexRoles.html.twig', array("rolesWaiter"=>$rolesWaiter));
    }


    //================== nuevo =================//

    /**
     * @Route("/new", name="newRoles", options={"expose"=true})
     * @Method("GET")
     */
    public function newAction()
    {
        return $this->render('AppBundle:Roles:newRol.html.twig');
    }

    //================= editar =================//

    /**
     * @Route("/{id}", name="editRoles", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     * @param Roles $rol
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Roles $rol)
    {
        $data = json_decode($this->get('serializer')->serialize($rol, 'json'),true);

        return $this->render('AppBundle:Roles:editRol.html.twig',array('editRol'=>$data));

    }



    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================= Add ================//

    /**
     * @Route("/new/", name="addRol", options={"expose"=true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $newRol = new Roles();

        $orderForm = $this->createForm(RolesType::Class, $newRol);

        $orderForm->submit($data);

        if ($orderForm->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($newRol);
            $em->flush();

        }else{
            dump('invalid');
        }

        $newRoles = json_decode($this->get('serializer')->serialize($newRol, 'json'), true);

        return new JsonResponse($newRoles);
    }

    //================= Upd(actualizar) =============//

    /**
     * @Route("/{id}/", name="updRoles", requirements={"id"="\d+"}, options={"expose"=true})
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
     * @Route("/{id}/", name="delRoles", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("DELETE")
     * @param Roles $rol
     * @return JsonResponse
     */
    public function delAction(Roles $rol)
    {
       $rolWaiter = $this->getDoctrine()->getManager();
       $rolWaiter->remove($rol);
       $rolWaiter->flush();

       $delete = json_decode($this->get('serializer')->serialize($rol,'json'),true);

       return new JsonResponse($delete);
    }
}
