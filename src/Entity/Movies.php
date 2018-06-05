<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Movies {
    private $id;
    public function getId() { return $this->id; }
    private $name;
    public function setName($name) { $this->name = $name; return $this; }
    public function getName() { return $this->name; }
    private $nameUrl;
    public function setNameUrl($nameUrl) { $this->nameUrl = $nameUrl; return $this; }
    public function getNameUrl() { return $this->nameUrl; }     
    private $director;
    public function setDirector($director) { $this->director = $director; return $this; }
    public function getDirector() { return $this->director; }   
    private $screenshot;
    public function setScreenshot($screenshot) { $this->screenshot = $screenshot; return $this; }
    public function getScreenshot() { return $this->screenshot; }  
    private $synopsis;
    public function setSynopsis($synopsis) { $this->synopsis = $synopsis; return $this; }
    public function getSynopsis() { return $this->synopsis; }                 
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
    public function getCreatedAt() { return $this->createdAt; } 
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }     
} 