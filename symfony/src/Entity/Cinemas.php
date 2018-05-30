<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Cinemas {
  /*
  private $roomsList;
  public function getRoomsList() { return $this->roomsList; }
  public function addRoomsList(Rooms $roomsList) { $this->roomsList[] = $roomsList; return $this; } 
  public function removeRoomsList(Rooms $roomsList) { $this->roomsList->removeElement($roomsList); } 
	public function __construct() {
		$this->roomsList = new ArrayCollection();	
  }
  */   
  private $id;
  public function getId() { return $this->id; }    
  private $name;
  public function setName($name) { $this->name = $name; return $this; }
  public function getName() { return $this->name; }
  private $nameUrl;
  public function setNameUrl($nameUrl) { $this->nameUrl = $nameUrl; return $this; }
  public function getNameUrl() { return $this->nameUrl; }    
  private $screenshot;
  public function setScreenshot($screenshot) { $this->screenshot = $screenshot; return $this; }
  public function getScreenshot() { return $this->screenshot; }  
  private $address;
  public function setAddress($address) { $this->address = $address; return $this; }
  public function getAddress() { return $this->address; }
  private $phone;
  public function setPhone($phone) { $this->phone = $phone; return $this; }
  public function getPhone() { return $this->phone; }      
  private $seatCapacity;
  public function setSeatCapacity($seatCapacity) { $this->seatCapacity = $seatCapacity; return $this; }
  public function getSeatCapacity() { return $this->seatCapacity; } 
  private $details;
  public function setDetails($details) { $this->details = $details; return $this; }
  public function getDetails() { return $this->details; }                            
}    