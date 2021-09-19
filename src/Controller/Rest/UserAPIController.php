<?php


 namespace App\Controller\Rest;


 use App\Entity\RegistrationUser;
 use App\Repository\RegistrationUserRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use FOS\RestBundle\Controller\Annotations as Rest;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;
 use FOS\RestBundle\Controller\AbstractFOSRestController;



 /**
   * Class UserAPIController
   */
  class UserAPIController extends AbstractFOSRestController {

  /**
  * @return JsonResponse
  * @Route("/usersAjax", methods={"GET"})
  */
    public function getAllUsers(RegistrationUserRepository $registrationUserRepository) {
      $data = $registrationUserRepository->findAll();
      $responseArray = array();

      foreach($data as $user) {
        $responseArray[] = array (
          "name" => $user->getName(),
          "surname" => $user->getSurname(),
          "username" => $user->getUsername(),
          "dateRegistered" => $user->getRegistrationDate()->format('Y-m-d'),
          "email" => $user->getEmail()
        );

      }

    //  $responseArray[] = array("name" => "Clemens", "surname" => "Pompidou", "username" => "cuteDoggy55", "dateRegistered" => '2021-11-2');

      $response = new Response( Response::HTTP_OK);
      $response->headers->set('Content-Type', 'application/json');
      $response->setContent(json_encode($responseArray));
      return $response;
    }



    /**
    * @return JsonResponse
    * @Route("/submitForm", methods={"POST"})
    */
      public function insertUser(RegistrationUserRepository $registrationUserRepository, Request $request) {

        $form = $request->request->get('form');

        $user = new RegistrationUser();

        if(!array_key_exists("name", $form) || !array_key_exists("surname", $form) || !array_key_exists("username", $form) || !array_key_exists("email", $form) || !array_key_exists("password", $form)) {

  //        return new JsonResponse("", 400);
          $response = new Response();
          $response->setStatusCode(Response::HTTP_BAD_REQUEST);
          $response->headers->set('Content-Type', 'application/json');
          return $response;
        }

  //      echo var_export($form);
        try {
            $user->setName($form['name']);
            $user->setSurname($form['surname']);
            $user->setUsername($form['username']);
            $user->setPassword($form['password']);
            $user->setEmail($form['email']);


          $response = new Response();
          $response->setStatusCode(Response::HTTP_OK);
          $response->headers->set('Content-Type', 'application/json');
          $response->setContent(json_encode(["message"=>var_export($request->request->get('form'),true)]));
        }
        catch(Exception $e) {
          $response = new Response();
          $response->setStatusCode(Response::HTTP_BAD_REQUEST);
          $response->headers->set('Content-Type', 'application/json');
          $response->setContent(json_encode(["message"=>"Data error"]));

        }

        $em = $this->getDoctrine()->getManager();

        try {
          $em->persist($user);
          $em->flush();
        }
        catch (Exception $e){
          $response = new Response();
          $response->setStatusCode(Response::HTTP_BAD_REQUEST);
          $response->headers->set('Content-Type', 'application/json');
          $response->setContent(json_encode(["message"=>"user can't be saved"]));
        }

        return $response;
      }




  }
