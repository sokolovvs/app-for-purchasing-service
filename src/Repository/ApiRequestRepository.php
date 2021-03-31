<?php

namespace App\Repository;


use App\Entity\ApiRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
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

    public function paginateApiRequests(array $params): Paginator
    {
        $limit = $params['limit'] ?? 20;
        $offset = $params['page'] ?? 1;

        $qb = $this->createQueryBuilder('ar');
        $qb->setMaxResults($limit)
            ->setFirstResult(($offset - 1) * $limit);

        if ($subscriptionId = $params['subscription_id'] ?? null) {
            $qb->andWhere('ar.subscription_id = :subscription_id')
                ->setParameter('subscription_id', $subscriptionId);
        }

        if ($dateMin = $params['date_min'] ?? null) {
            $qb->andWhere('ar.called_at >= :date_min')
                ->setParameter('date_min', $dateMin);
        }

        if ($dateMax = $params['date_max'] ?? null) {
            $qb->andWhere('ar.called_at <= :date_max')
                ->setParameter('date_max', $dateMax);
        }

        $qb->orderBy('ar.called_at', 'DESC');

        return new Paginator($qb->getQuery());
    }
}
