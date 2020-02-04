<?php

namespace App\Repository;

use App\Entity\ServerLoad;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method ServerLoad|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServerLoad|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServerLoad[]    findAll()
 * @method ServerLoad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerLoadRepository extends ServiceEntityRepository
{
    private $manager;
    /** @var QueryBuilder */
    private $qb;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, ServerLoad::class);
        $this->manager = $manager;
        $this->setQuery();
    }

    private function setQuery() {
        $this->qb = $this->_em->createQueryBuilder();
        $this->qb
            ->select('sl')
            ->from('App\Entity\ServerLoad', ' sl');
    }

    public function fetchQuery($from=null,$to=null): ?array
    {
        if($from) { $this->from($from); }
        if($to) { $this->to($to); }
        $query = $this->qb->getQuery();

        return $query->getArrayResult();
    }

    private function to(DateTimeInterface $value): void
    {
        $this->qb
            ->andWhere('sl.timestamp <= :toDate')
            ->setParameter('toDate', $value->format('Y-m-d H:i:s'));
        return;
    }

    private function from(DateTimeInterface $value): void
    {
        $this->qb
            ->andWhere('sl.timestamp >= :fromDate')
            ->setParameter('fromDate', $value->format('Y-m-d H:i:s'));
        return;
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
