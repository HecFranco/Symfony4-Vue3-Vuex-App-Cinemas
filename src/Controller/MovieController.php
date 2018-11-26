<?php
// src/Controller/MovieController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\Users;
use App\Entity\Cinemas;
use App\Entity\MovieShowings;
use App\Entity\Movies;
use App\Entity\Bookings;

class MovieController extends AppCinemaAbstractController {
	public function byCinema(Request $request, $cinemaUrl){
    $em = $this->getDoctrine()->getManager();
		$user_repo = $em->getRepository(Users::class);
		$cinemas_repo = $em->getRepository(Cinemas::class);	
		$movieShowings_repo = $em->getRepository(MovieShowings::class);
		$cinema = $cinemas_repo->findOneBy(array('nameUrl'=>$cinemaUrl));
		$moviesList = $movieShowings_repo->getListMoviesOfCinema($cinemaUrl);
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
		return $this->helpers->json($data);
	}
	public function byMovie(Request $request, $movieId){
    $em = $this->getDoctrine()->getManager();
		$bookings_repo = $em->getRepository(Bookings::class);
		$movieShowings_repo = $em->getRepository(MovieShowings::class);
		$movieShowings = $movieShowings_repo->findOneById($movieId);
		$bookingsList = $bookings_repo->findBy(array('movieShowingTime'=>$movieShowings));

		if($bookingsList === NULL){
			$data = array(
				'status' => 'error',
				'code'   => 500,
				'msg'	 => 'Search without result'
			);
		}else{
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'data' => $bookingsList
			);
		}
		return $this->helpers->json($data);
	}	
	public function findCinema(Request $request, $nameUrl = null){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $this->jwt_auth->checkToken($token);
    $user_repo = $em->getRepository(Users::class);
    $cinemas_repo = $em->getRepository(Cinemas::class);
		if($authCheck){
			$identity = $this->jwt_auth->checkToken($token, true);
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

		return $this->helpers->json($data);
	} 
	 
}