<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/notas")
 */
class NotasController extends Controller
{
    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================ index ==================//
    /**
     * @Route("", name="notasIndex", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $notaDB = $this->getDoctrine()->getRepository('AppBundle:Notas');
        $notasW = $notaDB->findAll();

        return $this->render('AppBundle:Notas:indexNotas.html.twig', array('notasW'=>$notasW));
    }

    //================ nuevo ===================//
    /**
     * @Route("/{id}{usuario}", name="notasNew", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET");
     * @param Request $request
     *
     */
    //TODO crear apis (add,upd,del), colocar id-nombres con select html, crear edit view
    public function newAction($id,$usuario)
    {

        return $this->render('AppBundle:Notas:newNotas.html.twig', array('ticketID'=>$id, 'usuarioID'=>$usuario));

    }
}
