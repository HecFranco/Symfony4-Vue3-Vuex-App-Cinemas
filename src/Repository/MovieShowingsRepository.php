<?php
// src/Repository/CinemasRepository.php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\MovieShowings;
use App\Entity\GenreMovie;
use App\Entity\Movies;
use App\Entity\MovieShowingTimes;

class MovieShowingsRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MovieShowings::class);
    }
    public function getListMoviesOfCinema($cinemaUrl): array {
        $em = $this->getEntityManager();
        $dateToday = new \DateTime('today');
        // $dateToday = date_format($dateToday, 'Y-m-d 00:00:00.000000');
        // automatically knows to select Cinemas
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('ms')
        ->select( 'ms.id', 'ms.showDate as show_date', 'm.id as movie_id', 'm.name', 'm.nameUrl as name_url', 'm.screenshot', 'm.director', 'm.synopsis', 'r.number', 'r.rows', 'r.seats')
        ->innerJoin('ms.cinema', 'c', 'c.id = ms.cinema')
        ->innerJoin('ms.movie', 'm', 'm.id = ms.movie')
        ->innerJoin('ms.room', 'r', 'r.id = ms.room')
        ->where('c.nameUrl =:cinema_url')
        ->andWhere('ms.showDate =:show_date')
        ->setParameter('cinema_url', $cinemaUrl)
        ->setParameter('show_date', $dateToday)
        //->orderBy('ms.showDate','ASC')
        ->getQuery();
        $listMovies = $qb->execute();
        $genreMovie_repo = $em->getRepository(GenreMovie::class); 
        $movie_repo = $em->getRepository(Movies::class);
        $movieShowing_repo = $em->getRepository(MovieShowings::class);
        $movieShowingTimes_repo = $em->getRepository(MovieShowingTimes::class);
        $listMoviesAdapted = array();
        foreach( $listMovies as $keyMovies => $valueMovies ){
            $movieShowing = $movieShowing_repo->findOneById($valueMovies['id']);
            $movieShowingTimes = $movieShowingTimes_repo->findBy(array('movieShowing'=>$movieShowing));
            $valueMovies['movie_showing_times'] = array();
            foreach($movieShowingTimes as $keyMovieShowingTimes => $valueMovieShowingTimes){
                $movieShowingTimesId = $valueMovieShowingTimes->getId();
                $movieShowingTimesHourToShow = $valueMovieShowingTimes->getHourToShow();
                $movieShowingTimes = ['id'=>$movieShowingTimesId, 'hour_to_show'=>$movieShowingTimesHourToShow];
                array_push($valueMovies['movie_showing_times'], $movieShowingTimes);
            } 
            $movie = $movie_repo->findOneById($valueMovies['movie_id']);
            $genreMovies = $genreMovie_repo->findBy(array('movie'=>$movie));
            $valueMovies['genres'] = array();                     
            foreach($genreMovies as $keyGenre => $valueGenre){
                $genreId = $valueGenre->getGenre()->getId();
                $genreName = $valueGenre->getGenre()->getName();
                $genre = ['id'=>$genreId, 'name'=>$genreName];
                array_push($valueMovies['genres'], $genre);
            }
            array_push($listMoviesAdapted,  $valueMovies);
        }
        return $listMoviesAdapted;
    }
}