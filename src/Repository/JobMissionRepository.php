<?php

namespace App\Repository;

use App\Entity\JobMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JobMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobMission[]    findAll()
 * @method JobMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobMission::class);
    }

    // /**
    //  * @return JobMission[] Returns an array of JobMission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobMission
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
