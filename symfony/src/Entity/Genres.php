<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Genres {
    private $id;
    public function getId() { return $this->id; }
    private $name;
    public function setName($name) { $this->name = $name; return $this; }
    public function getName() { return $this->name; }            
} 