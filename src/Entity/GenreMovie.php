<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class GenreMovie {
    private $id;
    public function getId() { return $this->id; }
    private $genre;
    public function setGenre($genre) { $this->genre = $genre; return $this; }
    public function getGenre() { return $this->genre; }    
    private $movie;
    public function setMovie($movie) { $this->movie = $movie; return $this; }
    public function getMovie() { return $this->movie; }          
} 