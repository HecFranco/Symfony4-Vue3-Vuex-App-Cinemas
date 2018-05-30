<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Seats {
    private $id;
    public function getId() { return $this->id; }    
    private $row;
    public function setRow($row) { $this->row = $row; return $this; }
    public function getRow() { return $this->row; }  
    private $number;    
    public function setNumber($number) { $this->number = $number; return $this; }
    public function getNumber() { return $this->number; }            
    private $state;
    public function setState(SeatState $state = null) { $this->state = $state; return $this; }
    public function getState() { return $this->state; }
    private $booking;
    public function setBooking(Bookings $booking = null) { $this->booking = $booking; return $this; }
    public function getBooking() { return $this->booking; }      
} 