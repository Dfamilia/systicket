<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Notas;
use AppBundle\Form\NotasType;

/**
 * @Route("/TicketNotas")
 */

class NotasController extends Controller
{
    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--VIEWS--////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================ index ==================//
    /**
     * @Route("/{ticketId}{uAsignadoId}", name="indexNotas", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction($ticketId, $uAsignadoId)
    {
        $notasBD = $this->getDoctrine()->getRepository('AppBundle:Notas')->findBy(array("ticketID"=>$ticketId));

        $data1 = $this->getDoctrine()->getRepository('AppBundle:Ticket')->find($ticketId)->getTitulo();
        $data2 = $this->getDoctrine()->getRepository('AppBundle:Usuario')->find($uAsignadoId)->getUsername();

        $tituloTicket = ($data1) ? $data1 : "none";
        $nombreuAsignado = ($data2) ? $data2 : "none" ;


        return $this->render('AppBundle:Notas:indexNotas.html.twig', array("notasXticket"=>$notasBD,"ticketId"=>$ticketId, "uAsignadoId"=>$uAsignadoId, "tituloTicket"=>$tituloTicket, "nombreuAsignado"=>$nombreuAsignado));
    }

    //================ New ==================//

    /**
     * @Route("/new/{ticketId}{uAsignadoId}", name="newNotasTicket", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("GET")
     */
    public function newAction($ticketId,$uAsignadoId)
    {
        $data1 = $this->getDoctrine()->getRepository('AppBundle:Ticket')->find($ticketId)->getTitulo();
        $data2 = $this->getDoctrine()->getRepository('AppBundle:Usuario')->find($uAsignadoId)->getUsername();

        $tituloTicket = ($data1) ? $data1 : "none";
        $nombreuAsignado = ($data2) ? $data2 : "none" ;

        return $this->render('AppBundle:Notas:newNotas.html.twig', array('ticketId'=>$ticketId, 'uAsignadoId'=>$uAsignadoId, "tituloTicket"=>$tituloTicket, "nombreuAsignado"=>$nombreuAsignado  ));

    }

    //++++++++++++++++++++++++++++++++++++++++++//
    /////////////////--APIs--/////////////////////
    //++++++++++++++++++++++++++++++++++++++++++//

    //================ Add ==================//
    /**
     * @Route("/new/", name="addNotasTicket", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */

    public function addAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $objNota = new Notas();

        $form = $this->createForm(NotasType::Class, $objNota);

        $form->submit($data);

        $date = new \DateTime();
        $date = $date->format("M/d/Y H:m a");

        $objNota->setFechaCreado($date);

        if($form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($objNota);
            $em->flush();
        }else
        {
            dump('no valid');
//            foreach ($form->getErrors() as $error)
//            {
//                $error[]=$error->getMessage();
//            }
        }

        $newNota = json_decode($this->get('serializer')->serialize($objNota, 'json'),true);

        return new JsonResponse($newNota);

    }

    //================ Delete ==================//

    /**
     * @Route("/del/{id}", name="delNotas", requirements={"id"="\d+"}, options={"expose"=true})
     * @Method("DELETE")
     * @param Notas $notas
     * @return JsonResponse
     */
    public function delAction(Notas $notas)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($notas);
        $em->flush();

        $delNotas = json_decode($this->get('serializer')->serialize($notas, 'json'), true);

        return new JsonResponse($delNotas);

    }


}//endClass
