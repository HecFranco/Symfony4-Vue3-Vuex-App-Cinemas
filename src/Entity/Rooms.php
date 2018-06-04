<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Rooms {
    private $id;
    public function getId() { return $this->id; }    
    private $rows;
    public function setRows($rows) { $this->rows = $rows; return $this; }
    public function getRows() { return $this->rows; }  
    private $seats;    
    public function setSeats($seats) { $this->seats = $seats; return $this; }
    public function getSeats() { return $this->seats; }  
    private $number;    
    public function setNumber($number) { $this->number = $number; return $this; }
    public function getNumber() { return $this->number; }            
    private $cinema;
    public function setCinema(Cinemas $cinema = null) { $this->cinema = $cinema; return $this; }
    public function getCinema() { return $this->cinema; }  
} 