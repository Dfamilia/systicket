<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Ticket;
use AppBundle\Form\TicketType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Form;

//----- Ruta General------//
/**
 * @Route("/ticket")
 */

class TicketController extends Controller

{
    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//


    //------Ruta del index del Ticket-----------//
    /**
     * @Route("/", name="ticket", options={"expose" = true})
     * @Method("GET")
     * @return JsonResponse
     */
    public function indexAction()
    {
        // replace this example code with whatever you need

        $datosticketBD = $this->getDoctrine()->getRepository('AppBundle:Ticket');

        $ticketList = $datosticketBD->findAll();
        return $this->render('AppBundle:Ticket:ticket.html.twig',array("ticketList"=>$ticketList));
    }

    //-------Ruta del form nuevo ticket-------//

    /**
     * @Route("/new", name="nuevoTicket", options={"expose" = true})
     * @Method("GET")
     * @return JsonResponse
     */
    public function newAction()
    {

        return $this->render('AppBundle:Ticket:nuevoticket.html.twig');
    }


    //--------Ruta de form editar ticket--------//

    /**
     * @Route("/{id}",
     *     name="editTicket",
     *     options={"expose" = true},
     *     requirements={"id"="\d+"})
     * @Method("GET")
     * @param Request $request
     * @param Ticket $ticket
     * @return JsonResponse
     */
    public function editAction(Request $request, Ticket $ticket)
    {
        $data = json_decode($this->get('serializer')->serialize($ticket, 'json'), true);

        return $this->render('AppBundle:Ticket:editticket.html.twig', array("ticket"=>$data));
    }



    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    /**
     * @todo al crear el ticket este no se guarda
     */


    //--------- Guardar datos del nuevo ticket --------------//
    /**
     * @Route("/new/", name="createTicket", options={"expose" = true})
     * @param Request $request
     * @Method("POST")
     * @return JsonResponse
     */
    public function postAction(Request $request){

        //obtener datos json del objeto request //
        $data = json_decode($request->getContent(), true);
        dump($data);


        //crear un objeto de la clase Entity:Usuario//
        $ticket = new Ticket();

        //crear objeto de la clase Form:UsuarioType//
        $form = $this->createForm(TicketType::class, $ticket);

        //finaliza y envia datos despues del debugeo interno de symfony
        $form->submit($data);



        //le cambio el formato al date time para que retorne un string y despues insertarlo
        $date = new \DateTime();
        $date = $date->format("Y-M-d H:m:s a");

        //inserta dato extra fuera de la validacion de symfony///
        $ticket->setFechaCreado($date);
        $ticket->setFechaStatus($date);
        $ticket->setFechaCierre($date);

        //preguntamos si es valido el formulario con el proceso de validacion de symfony
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();


        }else{
            foreach ($form->getErrors() as $error)
            {
                $error[] = $error->getMessage();
            }
            die;
        }

        $newTicket = json_decode($this->get('serializer')->serialize($ticket,'json'), true);

        return new JsonResponse($newTicket);

    }


    //----------- Actualizar datos el ticket----------------------//-

    /**
     * @Route("/{id}/",
     *     name="updTicket",
     *     requirements={"id"="\d+"},
     *     options={"expose"=true})
     * @Method("PUT")
     * @param Request $request
     * @param Ticket $updticket
     * @return JsonResponse
     */
    public function updAction(Request $request, Ticket $updticket)
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(TicketType::class, $updticket);

        //le cambio el formato al date time para que retorne un string y despues insertarlo
        $date = new \DateTime();
        $date = $date->format("y-M-d H:m a");


        //inserta dato extra fuera de la validacion de symfony///
        $updticket->setFechaCreado($date);
        $updticket->setFechaStatus($date);
        $updticket->setFechaCierre($date);


        $form->submit($data);

        if ($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->flush();

        }else{

            foreach ($form->getErrors() as $error){
                $errors[] = $error->getMessage();
            }
        }

        $updticket = json_decode($this->get('serializer')->serialize($updticket, 'json'), true);

        return new JsonResponse($updticket);
    }

    //----------- Borrar Ticket -----------------//

    /**
     * @Route("/{id}//",
     *     name="delTicket",
     *     requirements={"id"="\d+"},
     *     options={"expose"=true})
     *  @param Request $request
     * @param Ticket $delticket
     * @return JsonResponse
     */
    public function delAction(Request $request, Ticket $delticket){

        $data = json_encode($this->get('serializer')->serialize($delticket, 'json'), true);

        $em = $this->getDoctrine()->getManager();
        $em->remove($delticket);
        $em->flush();

        return $this->redirectToRoute('ticket');
    }


}