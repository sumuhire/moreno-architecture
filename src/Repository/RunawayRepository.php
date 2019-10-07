<?php

namespace App\Repository;

use App\Entity\Runaway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Runaway|null find($id, $lockMode = null, $lockVersion = null)
 * @method Runaway|null findOneBy(array $criteria, array $orderBy = null)
 * @method Runaway[]    findAll()
 * @method Runaway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RunawayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Runaway::class);
    }

    // /**
    //  * @return Runaway[] Returns an array of Runaway objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Runaway
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
