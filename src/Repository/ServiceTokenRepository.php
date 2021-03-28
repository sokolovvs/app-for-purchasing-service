<?php

namespace App\Repository;

use App\Entity\ServiceToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceToken[]    findAll()
 * @method ServiceToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceToken::class);
    }

    // /**
    //  * @return ServiceToken[] Returns an array of ServiceToken objects
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
    public function findOneBySomeField($value): ?ServiceToken
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
