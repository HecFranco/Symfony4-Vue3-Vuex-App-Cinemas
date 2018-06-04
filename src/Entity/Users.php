<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

class Users implements UserInterface {
    private $id;
		public function getId() { return $this->id; } 
    private $username;
    public function getUsername() { return $this->username; }
    public function setUsername($username=null) { $this->username = $username; }    
    private $name;    
		public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; } 		 	
		private $surname;
    public function setSurname($surname) { $this->surname = $surname; return $this; }
    public function getSurname() { return $this->surname; }		
		private $email;
    public function setEmail($email) { $this->email = $email; return $this; }
    public function getEmail() { return $this->email; }		
    private $plainPassword;
    public function getPlainPassword() { return $this->plainPassword; }
    public function setPlainPassword($password) { $this->plainPassword = $password; }    
    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     */
    private $password;
    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
		private $isActive;
    public function getIsActive() { return $this->isActive; }
    public function setIsActive($isActive) { $this->isActive = $isActive; }		
    public function __construct()     {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
		public function getCreatedAt() { return $this->createdAt; }
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }    
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
			// The bcrypt and argon2i algorithms don't require a separate salt.
			// You *may* need a real salt if you choose a different encoder.
			return null;
		}
		// other methods, including security methods like getRoles()
		private $role;
    public function setRole($role) { $this->role = $role; /*return $this;*/ }
		public function getRole() { return $this->role; }
		public function getRoles(){ return array('ROLE_USER','ROLE ADMIN'); }
		// ... and eraseCredentials()
		public function eraseCredentials() { }
		/** @see \Serializable::serialize() */
		public function serialize() {
				return serialize(array(
						$this->id,
						$this->username,
						$this->password,
						$this->role,
						// see section on salt below
						// $this->salt,
				));
		}
		public function unserialize($serialized) {
				list (
						$this->id,
						$this->username,
						$this->password,
						// see section on salt below
						// $this->salt
				) = unserialize($serialized);
		} 		
}