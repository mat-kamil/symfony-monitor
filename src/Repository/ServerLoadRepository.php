<?php

namespace App\Repository;

use App\Entity\ServerLoad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method ServerLoad|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServerLoad|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServerLoad[]    findAll()
 * @method ServerLoad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerLoadRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, ServerLoad::class);
        $this->manager = $manager;
    }

    public function addServerLoad(\DateTimeInterface $timestamp, float $cpuLoad, int $concurrency){
        $newServerLoad = new ServerLoad();
        $newServerLoad
            ->setTimestamp($timestamp)
            ->setCpuLoad($cpuLoad)
            ->setConcurrency($concurrency);
        $this->manager->persist($newServerLoad);
        $this->manager->flush();
    }

    public function findServerLoad(\DateTimeInterface $from, \DateTimeInterface $to){

    }

    // /**
    //  * @return ServerLoad[] Returns an array of ServerLoad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServerLoad
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
