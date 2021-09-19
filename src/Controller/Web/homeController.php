<?php
// src/Controller/homeController.php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class homeController extends AbstractController{

  /**
  * @Route("/home", name="homePage")
  */
  public function renderHomepage(): Response{

    return $this->render('home/home.htm.twig');
  }



}
