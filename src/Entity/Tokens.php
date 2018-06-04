<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Tokens {
    private $id;
    public function getId() { return $this->id; }    
    private $token;
    public function setToken($token) { $this->token = $token; return $this; }
    public function getToken() { return $this->token; }   
    private $type;
    public function setType($type) { $this->type = $type; return $this; }
    public function getType() { return $this->type; }  
    private $isRevoked;
    public function setIsRevoked($isRevoked) { $this->isRevoked = $isRevoked; return $this; }
    public function getIsRevoked() { return $this->isRevoked; }     
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
    public function getCreatedAt() { return $this->createdAt; } 
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }    
    private $user;
    public function setUser(Users $user) { $this->user = $user; return $this; }
    public function getUser() { return $this->user; }             
} 