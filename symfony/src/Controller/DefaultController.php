<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\Helpers;

use App\Entity\Users;

class DefaultController extends Controller {
  public function index (Request $request, Helpers $helpers){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
    $userList = $user_repo->findAll();
    /*
    return $this->render('base.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      'user'=>$user_repo
    ]);
    */
    return $helpers->json($userList);
  }
}