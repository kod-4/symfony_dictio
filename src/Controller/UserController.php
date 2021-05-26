<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserCompteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/compte", name="user_compte")
     */
    public function compte(Request $request, UserPasswordEncoderInterface $encoder, SessionInterface $session):Response{
        $user = $this->getUser();
        if(empty($session->get('password'))){
            $session->set('password', $user->getPassword());
        }
        $form = $this->createForm(UserCompteType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(is_null($user->getPassword())){ 
                $user->setPassword($session->get('password'));
            }else{   
                $plainPassword = $user->getPassword();
                $encodedPassword = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encodedPassword);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Modifications sauvegardés.");
        }
        
        return $this->render('user/compte.html.twig', ["form"=>$form->createView()]);
    }
    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles(['ROLE_USER']);
            $originePassword = $user->getPassword();
            $encodedPassword = $encoder->encodePassword($user, $originePassword);
            $user->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('inscription-confirmation');
        }
        //
        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/inscription-confirmation", name="inscription-confirmation")
     */
    public function confirmation(){
        return new Response('Vous êtes inscrit');
    }
}

