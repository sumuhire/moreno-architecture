<?php

namespace App\Repository;

use App\Entity\JobProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JobProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobProfile[]    findAll()
 * @method JobProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobProfile::class);
    }

    // /**
    //  * @return JobProfile[] Returns an array of JobProfile objects
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
    public function findOneBySomeField($value): ?JobProfile
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
