<?php
// src/Controller/CinemaController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\Users;
use App\Entity\Cinemas;

class CinemaController extends Controller {
	public function allCinemas(Request $request, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(Users::class);
		$cinemas_repo = $em->getRepository(Cinemas::class);
		//$cinemaList = $cinemas_repo->findAll();
		$cinemaList = $cinemas_repo->getListCinemas();
		$data = array(
			'status' => 'success',
			'code'   => 200,
			'data' => $cinemaList
		);
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