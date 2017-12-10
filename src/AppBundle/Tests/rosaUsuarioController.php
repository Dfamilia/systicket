<?php

namespace AppBundle\Controller;

use AppBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * @Route("/usuario")
 */

class UsuarioController extends Controller
{
    /**
     * @Route("/", name="create_user", options={"expose"=true})
     * @Method ({"GET"})
     */
	 
	  public function indexAction(Request $request)
    {
	    return $this->render('AppBundle:Usuario:usuario.html.twig');
		
		$usuario = new Usuario();
		$usuario->setNombres('');
		$usuario->setApellidos('');
		
		$form = $this->createFormBuilder($usuario)
			->add('nombres', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('apellidos', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('usuario', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('clave', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('tipousuario', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('rol', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('estadousuario', 'Symfony\Component\Form\Extension\Core\Type\TextType')
			->add('fecharegistrousuario', 'Symfony\Component\Form\Extension\Core\Type\DateType')
			->add('Save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('label'=>'Guardar'))
			->getForm();
			
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$Usuario = $form->getData();
				$data= $this->getDoctrine()->getManager();
         		$data->persist($Usuario);
         		$data->flush();
				return $this->redirectToRoute('Guardado');
			}

		
        // replace this example code with whatever you need
        return $this->render('AppBundle:Usuario:usuario.html.twig', array(
           // 'base_dir' => 'usuario'
		   'form' => $form->createView()
        ));
    }
	 
	 
	 //APIs
	 
	 /**
     * @Route("/", name="guardar_usuario", options={"expose"=true})
	 * @param Request $request
     * @Method ({"POST"})
	 * 
	 *@return JsonResponse
     */
	 
	 public function postUser (Request $request)
	 {
		 $data = json_decode($request->getContent(),  true);

		 $user = new Usuario();
		 $form = $this->createForm(UsuarioType::class, $user);

		 $form->submit($data);

		 $user->setUserCreateDate(new \DateTime());


		 if ($form->isValid()){
		     $em = $this->getDoctrine()->getManager();
		     $em->persist($user);
		     $em->flush();

		     //dump
         }
         else {

         }
         $newUser = json_decode($this->get('serializer')->serialize($user, 'json'), true);

		 return new JsonResponse($newUser);
	 }

	}
