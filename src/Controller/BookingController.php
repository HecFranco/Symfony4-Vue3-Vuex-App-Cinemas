<?php
// src/Controller/BookingController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\Bookings;
use App\Entity\Users;
use App\Entity\Customers;
use App\Entity\MovieShowingTimes;
use App\Entity\Seats;

class BookingController extends Controller {
	public function saveBooking(Request $request, Helpers $helpers, JwtAuth $jwt_auth){  
		$em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $jwt_auth->checkToken($token);
		if($authCheck){
			// Load Repositories
			$user_repo = $em->getRepository(Users::class);
			$customers_repo = $em->getRepository(Customers::class);		
			$movieShowingTimes_repo = $em->getRepository(MovieShowingTimes::class);
			// Extract id user of token
			$identity = $jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
			$customer = $customer_repo->findOneBy(array('user'=>$user));
			// Receive json by POST
			$json = $request->get('json', null);
			$params = json_decode($json);
			// Extract data of Json
			$customer_id = (isset($params->customer_id)) ? $params->customer_id : null;
			$movieShowingTimes_id = (isset($params->movie_showing_time_id)) ? $params->movie_showing_time_id : null;
			$booking_made_date = new \Datetime("now");
			$booking_seats = (isset($params->booking_seat_count)) ? $params->booking_seat_count : null;
			// Others searchings
			$customer = $customers_repo->findOneById($customer_id);
			$movieShowingTimes = $movieShowingTimes_repo->findOneById($movieShowingTimes_id);
			// Persist Data of Booking
			$booking = new Bookings();
			$booking->setCustomer($customer);
			$booking->setMovieShowingTimes($movieShowingTimes);
			$booking->setMadeDate($booking_made_date);
			$booking->setSeatCount(count($booking_seats));
			$em->persist($booking);
			$em->flush();
			// Generate data for 
			foreach( $booking_seats as $key => $value ){
				// $value 1-5
				$dataSeat = explode("-", $value);
				$seatRow = $dataSeat[0];
				$seatNumber = $dataSeat[1];
				$state = "BOOKED";
			}
			// Persist Data of Booking
			$seats = new Seats();
			$seats->setRow($seatRow);
			$seats->setNumber($seatNumber);
			$seats->setState($state);
			$seats->setBooking($booking);
			$em->persist($seats);
			$em->flush();
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'msg'	 => 'Reserved Correct'
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
	public function lastBooking(Request $request, Helpers $helpers, JwtAuth $jwt_auth){  
		$em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
    $authCheck = $jwt_auth->checkToken($token);
		if($authCheck){
			// Load Repositories
			$user_repo = $em->getRepository(Users::class);
			$customers_repo = $em->getRepository(Customers::class);		
			$movieShowingTimes_repo = $em->getRepository(Bookings::class);
			// Extract id user of token
			$identity = $jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
			$customer = $customer_repo->findOneBy(array('user'=>$user));
			// Extract Last Booking of the customer
			$lastBooking = $movieShowingTimes_repo->findOneBy(array('customer'=>$customer));
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'data'	 => $lastBooking
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
	public function allBookings(Request $request, Helpers $helpers, JwtAuth $jwt_auth){  
		$em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
		if($authCheck){
			// Load Repositories
			$user_repo = $em->getRepository(Users::class);
			$customers_repo = $em->getRepository(Customers::class);		
			$movieShowingTimes_repo = $em->getRepository(Bookings::class);
			// Extract id user of token
			$identity = $jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
			$customer = $customers_repo->findAll(array('user'=>$user));
			// Extract Last Booking of the customer
			$lastBooking = $movieShowingTimes_repo->findOneBy(array('customer'=>$customer));
			$data = array(
				'status' => 'success',
				'code'   => 200,
				'data'	 => $lastBooking
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