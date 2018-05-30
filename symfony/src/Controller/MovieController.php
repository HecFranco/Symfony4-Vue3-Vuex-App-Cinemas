<?php
// src/Controller/MovieController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\Users;
use App\Entity\Cinemas;
use App\Entity\MovieShowings;

class MovieController extends Controller {
	public function byCinema(Request $request, $cinemaUrl, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $jwt_auth->checkToken($token);
		$cinemas_repo = $em->getRepository(Cinemas::class);
		$movieShowings_repo = $em->getRepository(MovieShowings::class);
		$cinema = $cinemas_repo->findOneBy(array('nameUrl'=>$cinemaUrl));	
		$moviesList = $movieShowings_repo->findBy(array('cinema'=>$cinema));	
		if($cinema === NULL){
			$data = array(
				'status' => 'error',
				'code'   => 500,
				'msg'	 => 'Search without result'
			);
		}else{
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'data' => $moviesList
			);
		}
		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
			$user_repo = $em->getRepository(Users::class);
      $user = $user_repo->findOneById($identity->sub);
		}
		return $helpers->json($data);
	}
	public function findCinema(Request $request, $nameUrl = null, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $jwt_auth->checkToken($token);
    $user_repo = $em->getRepository(Users::class);
    $cinemas_repo = $em->getRepository(Cinemas::class);
		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
      $cinema = $cinemas_repo->findOneBy(array('nameUrl'=>$nameUrl));
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

		return $helpers->json($data);
	}  
}