<?php
// src/Controller/homeController.php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\RegistrationUser;


class listUsersController extends AbstractController{

  /**
  * @Route("/users", name="listUsers")
  */
  public function renderHomepage(): Response{

    return $this->render('listUsers/listUsers.html.twig');
  }


}
