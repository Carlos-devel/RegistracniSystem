<?php
// src/Controller/registrationController.php

namespace App\Controller\Web;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\RegistrationUser;




class registrationController extends AbstractController{

  /**
  * @Route("/registration", name="registrationPage")
  */
  public function renderRegistrationPage(): Response{

    $form = $this->createFormBuilder(new RegistrationUser())->getForm();
    $form->add('name', TextType::class, ['required' => FALSE]);
    $form->add('surname', TextType::class, ['required' => FALSE]);
    $form->add('username', TextType::class);
    $form->add('email', TextType::class);
    $form->add('password', PasswordType::class);
    $form->add('register', SubmitType::class, ['label' => 'Register user']);



    return $this->render('registration/registration.html.twig', [
      'form' => $form->createView(),
    ]);
  }




}
