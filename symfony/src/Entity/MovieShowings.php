<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class MovieShowings {
    private $id;
    public function getId() { return $this->id; }    
    private $showDate;
    public function setShowDate($showDate) { $this->showDate = $showDate; return $this; }
    public function getShowDate() { return $this->showDate; }  
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
    public function getCreatedAt() { return $this->createdAt; } 
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }  
    private $cinema;
    public function setCinema(Cinemas $cinema) { $this->cinema = $cinema; return $this; }
    public function getCinema() { return $this->cinema; }  
    private $movie;
    public function setMovie(Movies $movie) { $this->movie = $movie; return $this; }
    public function getMovie() { return $this->movie; }
    private $room;
    public function setRoom(Rooms $room) { $this->room = $room; return $this; }
    public function getRoom() { return $this->room; }                           
}    