<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Users;

class DefaultController extends Controller {
  public function test (request $request) {
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
    $userList = $user_repo->findAll();
    var_dump($userList);die();
    return $this->render('base.html.twig', [
      'base_dir' =>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      'user'=>$userList
    ]);
  }
  public function vueExample (request $request) {
    return $this->render('default/vue-example.html.twig');
  }  
}