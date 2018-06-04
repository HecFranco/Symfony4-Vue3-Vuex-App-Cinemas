<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Bookings {
    private $id;
    public function getId() { return $this->id; }    
    private $madeDate;
    public function setMadeDate($madeDate) { $this->madeDate = $madeDate; return $this; }
    public function getMadeDate() { return $this->madeDate; }
    private $seatCount;
    public function setSeatCount($seatCount) { $this->seatCount = $seatCount; return $this; }
    public function getSeatCount() { return $this->seatCount; }
    private $movieShowingTime;
    public function setMovieShowingTime(MovieShowingTimes $movieShowingTime = null) { $this->movieShowingTime = $movieShowingTime; return $this; }
    public function getMovieShowingTime() { return $this->movieShowingTime; } 
    private $customer;
    public function setCustomer(Customers $customer = null) { $this->customer = $customer; return $this; }
    public function getCustomer() { return $this->customer; }          
}    