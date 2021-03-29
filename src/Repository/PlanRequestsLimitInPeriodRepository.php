<?php

namespace App\Repository;

use App\Entity\PlanRequestsLimitInPeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanRequestsLimitInPeriod|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanRequestsLimitInPeriod|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanRequestsLimitInPeriod[]    findAll()
 * @method PlanRequestsLimitInPeriod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanRequestsLimitInPeriodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanRequestsLimitInPeriod::class);
    }

    // /**
    //  * @return PlanRequestsLimitInPeriod[] Returns an array of PlanRequestsLimitInPeriod objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanRequestsLimitInPeriod
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
