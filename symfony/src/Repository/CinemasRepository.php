<?php
// src/Repository/CinemasRepository.php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\Cinemas;
use App\Entity\Rooms;

class CinemasRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Cinemas::class);
    }
    public function getListCinemas(): array {
        $em = $this->getEntityManager();
        // automatically knows to select Cinemas
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('c')
        ->select( 'c.id', 'c.name', 'c.nameUrl', 'c.screenshot', 'c.address', 'c.phone', 'c.seatCapacity', 'c.details')
        ->orderBy('c.name','ASC')
        ->getQuery();
        $listCinemas = $qb->execute();
        $rooms_repo = $em->getRepository(Rooms::class);  
        foreach( $listCinemas as $key => $value ){
          $roomsList = $rooms_repo->findBy(array('cinema'=>$value['id']));
          $countRooms = count($roomsList);      
          $listCinemas[$key]['countRooms'] = $countRooms;        
        }
        return $listCinemas;
    }

}