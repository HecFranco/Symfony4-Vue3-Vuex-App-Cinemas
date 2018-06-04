<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Customers {
    private $id;
    public function getId() { return $this->id; }
    private $phone;
    public function setPhone($phone) { $this->phone = $phone; return $this; }
    public function getPhone() { return $this->phone; }    
    private $creditCard;
    public function setCreditCard($creditCard) { $this->creditCard = $creditCard; return $this; }
    public function getCreditCard() { return $this->creditCard; }   
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