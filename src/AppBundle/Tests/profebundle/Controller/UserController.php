<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/usuario")
 */
class UserController extends Controller
{


    // APIs

    /**
     * @Route("/", name="lista_usuario")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $usersD = json_decode($this->get('serializer')->serialize($users, 'json'), true);

        return new JsonResponse($usersD);
    }


    /**
     * @Route("/{id}", name="get_usuario", requirements={"id"="\d+"} )
     * @Method("GET")
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function getUsuario(Request $request, User $user)
    {
        $userJ = json_decode($this->get('serializer')->serialize($user, 'json'), true);
        return new JsonResponse($userJ);
    }


    /**
     * @Route("/", name="guardar_usuario", options={"expose"=true})
     * @param Request $request
     * @Method({"POST"})
     *
     * @return JsonResponse
     */
    public function postUser(Request $request)
    {

        $data = json_decode($request->getContent(), true);



        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->submit($data);

        $user->setFecharegistro(new \DateTime());
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

           // dump("is valida");
           // dump($user);
        } else {

            foreach ($form->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }

           // dump("No es valido");
           // dump($this->getFormErrors($form));
        }

        $newUser = json_decode($this->get('serializer')->serialize($user, 'json'),true);

        return new JsonResponse($newUser);
    }


    private function getFormErrors(Form $form)
    {

        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getFormErrors($childForm)) {
                    #$errors[$childForm->getName()] = $childErrors;
                    foreach ($childErrors as $childError) {
                        $errors[] = $childError;
                    }
                }
            }
        }
        return $errors;
    }

}
