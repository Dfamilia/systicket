<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/ticket")
 */
class TicketController extends Controller
{

    //------Ruta del index de usuario con symfony rest-----------//

    /**
     * @Route("/", name="ticket", options={"expose" = true})
     * @return JsonResponse
     * @param Request $request
     */

    public function indexAction(Request $request)
    {
    // replace this example code with whatever you need
        
        $datosticketBD = $this->getDoctrine()->getRepository('AppBundle:Ticket');
        
        $ticketList = $datosticketBD->findAll();

        
        //$usuarioList = new JsonResponse($ticketList);

         return $this->render('AppBundle:Ticket:ticket.html.twig',array("ticketList"=>$ticketList));
    }


}
