<?php
// src/Controller/AuthenticationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\Users;
use App\Entity\Customers;

class AuthenticationController extends AppCinemaAbstractController {
  public function login(Request $request){
		// Receive json by POST
		$json = $request->get('json', null);
		
    // Array to return by default
    $data = array(
        'status' => 'error',
        'data' => 'Send json via post !!'
    );
    if($json != null){
        // you make the login
        // We convert a json to a php object
				$params = json_decode($json);
				$params = $params->user;
        $email = (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;
        $getHash = (isset($params->getHash)) ? $params->getHash : null;
				$emailConstraint = new Assert\Email();
        $emailConstraint->message = "This email is not valid !!";
        $validate_email = $this->get("validator")->validate($email, $emailConstraint);
        // Encrypt the password
        $pwd = hash('sha256', $password);
        if($email != null && count($validate_email) == 0 && $password != null){
						$token = $this->jwt_auth->signup($email, $pwd);
            return new JsonResponse($token);
        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Email or password incorrect'
            );
        }        
    }
    return $this->helpers->json($data);
  } 
  public function register(Request $request){
    // Entity manager
    $em = $this->getDoctrine()->getManager();
		$json = $request->get("json", null);
		$params = json_decode($json);
		$params = $params->user;
    $user_repo = $em->getRepository(Users::class);

		$data = array(
			'status' => 'error',
			'code'   => 400,
			'msg'	 => 'User not created !!'
		);
		
		if($json != null){
			$createdAt = new \Datetime("now");
			$role = ( count($user_repo->findAll())==0 ) ? 'ROLE_ADMIN' : 'ROLE_USER' ;

			$email = (isset($params->email)) ? $params->email : null;
			$username = (isset($params->username)) ? $params->username : null;
      $name = (isset($params->name)) ? $params->name : null;
			$surname = (isset($params->surname)) ? $params->surname : null;
			$password = (isset($params->password)) ? $params->password : null;
			
			$emailConstraint = new Assert\Email();
			$emailConstraint->message = "This email is not valid !!";
			$validate_email = $this->get("validator")->validate($email, $emailConstraint);

			if($email != null && count($validate_email) == 0 && $password != null){
					$isset_user = $user_repo->findBy(array( "email" => $email ));
					if(count($isset_user) == 0){
						$user = new Users();
						$user->setCreatedAt($createdAt);
						$user->setUpdatedAt($createdAt);
						$user->setRole($role);
						$user->setEmail($email);
						$user->setUsername($username);
						$user->setName($name);
						$user->setSurname($surname);
						// Encrypt the password
						$pwd = hash('sha256', $password);
						$user->setPassword($password);          
						$user->setPlainPassword($pwd);
						$em->persist($user);
						$em->flush();

						$customer = new Customers();
						$customer->setUser($user);
						$customer->setPhone(null);
						$customer->setCreditCard(null);
						$customer->setCreatedAt($createdAt);
						$customer->setUpdatedAt($createdAt);
						$em->persist($customer);
						$em->flush();
						
						$data = array(
							'status' => 'success',
							'code'   => 200,
							'msg'	 => 'New user created !!',
							'user'   => $user
						);
					}else{
						$data = array(
							'status' => 'error',
							'code'   => 400,
							'msg'	 => 'User not created, duplicated !!'
						);
					}
			}
		}

		return $this->helpers->json($data);
  }
	public function editProfile(Request $request){
    // Entity manager
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $this->jwt_auth->checkToken($token);

    $user_repo = $em->getRepository(Users::class);

		if($authCheck){
				// Obtain user data identified via token
				$identity = $this->jwt_auth->checkToken($token, true);
				// Get the object to update
				$user = $user_repo->findOneBy(array( 'id' => $identity->sub ));
				// Collect post data
				$json = $request->get("json", null);
				$params = json_decode($json);
				// Default error array
				$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'User not updated !!' );
				if($json != null){
					//$createdAt = new \Datetime("now");
					$role = 'user';

					$email = (isset($params->email)) ? $params->email : null;
          $username = (isset($params->username)) ? $params->username : null;
					$name = (isset($params->name)) ? $params->name : null;
					$surname = (isset($params->surname)) ? $params->surname : null;
					$password = (isset($params->password)) ? $params->password : null;
          $createdAt = $user->getCreatedAt();
          $updatedAt = new \Datetime("now");
					$emailConstraint = new Assert\Email();
					$emailConstraint->message = "This email is not valid !!";
					$validate_email = $this->get("validator")->validate($email, $emailConstraint);

					if($email != null && count($validate_email) == 0 && $name != null && $surname != null){
							//$user->setCreatedAt($createdAt);
							$user->setRole($role);
							$user->setEmail($email);
              $user->setUsername($username);              
							$user->setName($name);
							$user->setSurname($surname);
              $user->setCreatedAt($createdAt);
              $user->setUpdatedAt($updatedAt);
							// Encrypt the password
							if($password != null){
								$pwd = hash('sha256', $password);
                $user->setPassword($password);          
                $user->setPlainPassword($pwd);
							}
							$isset_user = $user_repo->findBy(array( "email" => $email )); 
							if(count($isset_user) == 0 || $identity->email == $email){
								$em->persist($user);
								$em->flush();
								$data = array( 'status' => 'success', 'code' => 200, 'msg' => 'New user updated !!', 'user' => $user );
							}else{
								$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'User not updated, duplicated !!' );
							}
					}
				}
		}else{
			$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'Authorization not valid' );
		}
		return $this->helpers->json($data);
	}  
}