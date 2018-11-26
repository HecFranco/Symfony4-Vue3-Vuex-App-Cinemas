<?php
// src/Controller/GenreController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\Users;
use App\Entity\Genres;

class GenreController extends AppCinemaAbstractController {
	public function allGenres(Request $request){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
    $genres_repo = $em->getRepository(Genres::class);
    $genresList = $genres_repo->findAll();
		$data = array(
			'status' => 'success',
			'code'   => 200,
			'data' => $genresList
		);
		return $this->helpers->json($data);
  }
  
	public function findCinema(Request $request, $id = null){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $this->jwt_auth->checkToken($token);
    $user_repo = $em->getRepository(Users::class);
    $cinemas_repo = $em->getRepository(Cinemas::class);
		if($authCheck){
			$identity = $this->jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
      $cinema = $cinemas_repo->findOneById($id);
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'data' => $cinema
			);
		}else{
			$data = array(
				'status' => 'error',
				'code'   => 400,
				'msg'	 => 'Authorization not valid'
			);
		}

		return $this->helpers->json($data);
	}  
}