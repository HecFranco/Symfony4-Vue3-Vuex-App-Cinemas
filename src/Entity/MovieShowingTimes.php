<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class MovieShowingTimes {
    private $id;
    public function getId() { return $this->id; }    
    private $hourToShow;
    public function setHourToShow($hourToShow) { $this->hourToShow = $hourToShow; return $this; }
    public function getHourToShow() { return $this->hourToShow; }    
    private $movieShowing;
    public function setMovieShowing(MovieShowings $movieShowing = null) { $this->movieShowing = $movieShowing; return $this; }
    public function getMovieShowing() { return $this->movieShowing; }  
}    