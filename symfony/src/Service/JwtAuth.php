<?php
// src/Service/JwtAuth.php
namespace App\Service;

use App\Entity\Users;

use Firebase\JWT\JWT;

class JwtAuth{
	public $manager;
	public $key;
	public function __construct($manager){
		$this->manager = $manager;
		$this->key = 'helloHowIAmTheSecretKey-98439284934829';
	}
	public function signup($email, $password, $getHash = null){
		$user = $this->manager->getRepository(Users::class)->findOneBy(array(
			"email" => $email,
			"plainPassword" => $password
		));	
		$signup = (is_object($user))? true : false;
		if($signup == true){
			// GENERATE TOKEN JWT
			$token = array(
				"sub"   => $user->getId(),
				"email" => $user->getEmail(),
				"username"	=> $user->getUsername(),
				"name"	=> $user->getName(),
				"surname" => $user->getSurname(),
				"password" => $user->getPassword(),
				"is_active" => $user->getPassword(),
				"role" => $user->getRole(),
				"iat"	=> time(),
				"exp"	=> time() + (7 * 24 * 60 * 60)
			);
			
			$jwt = JWT::encode($token, $this->key, 'HS256');
			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
			$data = ($getHash == null)? $jwt : $decoded ;

		}else{
			$data = array( 'status' => 'error', 'data' => 'Login failed!!' );
		}
		return $data;
	}

	public function checkToken($jwt, $getIdentity = false){
		$auth = false;
		try{
			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
		}catch(\UnexpectedValueException $e){ 
			$auth = false; 
		}catch(\DomainException $e){ 
			$auth = false; 
		}
		$auth = (isset($decoded) && is_object($decoded) && isset($decoded->sub))?true:false;
		return ($getIdentity == false) ? $auth : $decoded ;
	}
}