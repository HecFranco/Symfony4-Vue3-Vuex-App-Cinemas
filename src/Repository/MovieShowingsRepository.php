<?php
// src/Repository/CinemasRepository.php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\MovieShowings;

class MovieShowingsRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MovieShowings::class);
    }
    public function getListMoviesOfCinema($cinemaUrl): array {
        $em = $this->getEntityManager();
        // automatically knows to select Cinemas
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('ms')
        ->select( 'ms.id', 'm.id', 'm.name', 'm.nameUrl', 'm.screenshot', 'm.director', 'm.synopsis', 'r.number', 'r.rows', 'r.seats')
        ->innerJoin('ms.cinema', 'c', 'c.id = ms.cinema')
        ->innerJoin('ms.movie', 'm', 'm.id = ms.movie')
        ->innerJoin('ms.room', 'r', 'r.id = ms.room')
        ->where('c.nameUrl =:cinema_url')
        ->setParameter('cinema_url', $cinemaUrl)
        ->orderBy('ms.showDate','ASC')
        ->getQuery();
        $listMovies = $qb->execute();
        return $listMovies;
    }

}