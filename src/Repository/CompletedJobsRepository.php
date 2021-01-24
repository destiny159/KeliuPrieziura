<?php

namespace App\Repository;

use App\Entity\CompletedJobs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompletedJobs|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompletedJobs|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompletedJobs[]    findAll()
 * @method CompletedJobs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompletedJobsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompletedJobs::class);
    }

    // /**
    //  * @return CompletedJobs[] Returns an array of CompletedJobs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompletedJobs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
