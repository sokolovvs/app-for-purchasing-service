<?php

namespace App\Repository;


use App\Entity\ApiRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApiRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiRequest[]    findAll()
 * @method ApiRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiRequestRepository extends AbstractDoctrineRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, $entityManager, ApiRequest::class);
    }

}
