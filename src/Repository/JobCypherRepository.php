<?php

namespace App\Repository;

use App\Entity\JobCypher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobCypher|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobCypher|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobCypher[]    findAll()
 * @method JobCypher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobCypherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobCypher::class);
    }

    // /**
    //  * @return JobCypher[] Returns an array of JobCypher objects
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
    public function findOneBySomeField($value): ?JobCypher
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
