<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\CategoriaTicket;
use AppBundle\Form\TicketType;
use Symfony\Component\HttpFoundation\JsonResponse;


//----- Ruta General------//
/**
 * @Route("/ticket")
 */

class TicketController extends FOSRestController

{
    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//


    // ============== Ticket ================== //
    /**
     * @Route("", name="indexTicket", options={"expose" = true})
     * @Method("GET")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $cliente = array();
        $empleado = array();

        $datosticketBD = $this->getDoctrine()->getRepository('AppBundle:Ticket');
        $usuariosBD = $this->getDoctrine()->getRepository('AppBundle:Usuario');

        $ticketList = $datosticketBD->findAll();

        if (!empty($ticketList)){

            foreach ($ticketList as $item){

                if (!empty($item->getUsuarioSolicitanteID())){

                    $dataObj = $usuariosBD->find($item->getUsuarioSolicitanteID());

                    if( !empty($dataObj) )
                    {
                        $cliente[]=["id"=>$dataObj->getid(), "username"=>$dataObj->getusername()];

                    }

                }
                 else
                 {
                    $cliente[]=["id"=>0, "username"=>"none"];
                 }

                if (!empty($item->getUsuarioAsignadoID())){

                    $dataObj2 = $usuariosBD->find($item->getUsuarioAsignadoID());

                    if( !empty($dataObj2) )
                    {
                        $empleado[]=["id"=>$dataObj2->getid(), "username"=>$dataObj2->getusername()];

                    }

                }
                else
                {
                    $empleado[]=["id"=>0, "username"=>"none"];
                }
            }

        }
        return $this->render('AppBundle:Ticket:indexTicket.html.twig',array("ticketList"=>$ticketList, "usuarioCliente"=>$cliente, "usuarioAsignado"=>$empleado ));
    }

    //-------Ruta del form nuevo ticket-------//

    /**
     * @Route("/new", name="newTicket", options={"expose" = true})
     * @Method("GET")
     */
    public function newAction()
    {
        $cliente = array();
        $asignado = array();


        $usuarioBD = $this->getDoctrine()->getRepository('AppBundle:Usuario');
        $usuarioW = $usuarioBD->findAll();

        if (!empty($this->getDoctrine()->getRepository('AppBundle:CategoriaTicket')->findAll()))
        {
            $categoria = $this->getDoctrine()->getRepository('AppBundle:CategoriaTicket')->findAll();

        }else
            {
             $categoria = array();
            }

        if (!empty($usuarioW)) {

            foreach ($usuarioW as $item) {

                if (($item->getTipoUser()) == "Cliente")
                {
                    $cliente[] = ["id" => $item->getid(), "username" => $item->getusername()];

                }elseif (($item->getTipoUser()) == "Soporte")
                {

                    $asignado[]=["id"=>$item->getid(), "username"=>$item->getusername()];

                }

            }
        }else
        {
            $cliente[]=["id"=>0, "username"=>"none"];
            $asignado[]=["id"=>0, "username"=>"none"];
        }

        return $this->render('AppBundle:Ticket:newTicket.html.twig', array('uCliente'=> $cliente, "uAsignado"=>$asignado, "Categoria"=>$categoria ));
    }


    //--------Ruta de form editar ticket--------//

    /**
     * @Route("/{id}", name="editTicket", options={"expose" = true}, requirements={"id"="\d+"})
     * @Method("GET")
     * @param Ticket $ticket
     */
    public function editAction(Ticket $ticket, $id)
    {
        $data = json_decode($this->get('serializer')->serialize($ticket, 'json'), true);

        $cliente = array();
        $asignado = array();

        $usuarioW = $this->getDoctrine()->getRepository('AppBundle:Usuario')->findAll();

        $categoria = $this->getDoctrine()->getRepository('AppBundle:CategoriaTicket')->findAll();


        if (!empty($usuarioW)) {

            foreach ($usuarioW as $item) {

                if (($item->getTipoUser()) == "Cliente")
                {
                    $cliente[] = ["id" => $item->getid(), "username" => $item->getusername()];

                }elseif (($item->getTipoUser()) == "Soporte")
                {

                    $asignado[]=["id"=>$item->getid(), "username"=>$item->getusername()];

                }

            }
        }else
        {
            $cliente[]=["id"=>0, "username"=>"none"];
            $asignado[]=["id"=>0, "username"=>"none"];
        }


        return $this->render('AppBundle:Ticket:editTicket.html.twig', array("ticket"=>$data,'uCliente'=> $cliente, "uAsignado"=>$asignado, "Categoria"=>$categoria));
    }



    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//



    //--------- Guardar datos del nuevo ticket --------------//
    /**
     * @Route("/new/", name="addTicket", options={"expose" = true})
     * @param Request $request
     * @Method("POST")
     * @return JsonResponse
     */
    public function postAction(Request $request){

        //obtener datos json del objeto request //
        $data = json_decode($request->getContent(), true);

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

        }

        $newTicket = json_decode($this->get('serializer')->serialize($ticket,'json'), true);

        return new JsonResponse($newTicket);

    }


    //----------- Actualizar datos el ticket----------------------//-

    /**
     * @Route("/{id}/", name="updTicket", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("PUT")
     * @param Request $request
     * @param Ticket $updticket
     * @return JsonResponse
     */
    public function updAction(Request $request, Ticket $updticket)
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(TicketType::class, $updticket);

        $form->submit($data);

        //le cambio el formato al date time para que retorne un string y despues insertarlo
        $date = new \DateTime();
        $date = $date->format("Y-M-d H:m:s a");

        //inserta dato extra fuera de la validacion de symfony///
        $updticket->setFechaCreado($date);
        $updticket->setFechaStatus($date);
        $updticket->setFechaCierre($date);

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
     * @Route("/{id}//", name="delTicket", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("DELETE")
     * @param Ticket $delticket
     * @return JsonResponse
     */
    public function delAction(Ticket $delticket, $id){

       // $data = json_encode($this->get('serializer')->serialize($delticket, 'json'), true);
        $notasTicket = $this->getDoctrine()->getRepository('AppBundle:Notas')->findBy(array("ticketID"=>$id));

        $em = $this->getDoctrine()->getManager();

        //esto elimina todas las notas que existen del ticket
        foreach ($notasTicket as $notas){
            $em->remove($notas);
        }

        //esto elimina el ticket
        $em->remove($delticket);

        $em->flush();

        $Ticket = json_decode($this->get('serializer')->serialize($delticket, 'json'), true);

        return new JsonResponse($Ticket);
    }


}