<?php


namespace App\Repository\User;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\User\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function getById($id): Customer
    {
        $customer = $this->find($id);

        if ($customer !== null) {
            return $customer;
        }

        throw new ResourceNotFoundException('Customer not found', null, ['id' => $id]);
    }

    public function getCustomersByParams(array $params): Paginator
    {
        $page = $params['page'] ?? 1;
        $offset = $params['limit'] ?? 10;

        $qb = $this->createQueryBuilder('u')
            ->innerJoin('u.subscriptions', 's')
            ->innerJoin('s.status', 'ss')
            ->innerJoin('s.plan', 'p');

        if ($userActiveStatuses = $params['user_active_statuses'] ?? []) {
            $qb->andWhere('u.is_active IN (:active_statuses)')
                ->setParameter('active_statuses', $userActiveStatuses);
        }

        if ($email = $params['email'] ?? '') {
            $qb->andWhere('u.email LIKE :email')
                ->setParameter('email', "%$email%");
        }

        if ($subscriptionStatuses = $params['subscription_statuses'] ?? []) {
            $qb->andWhere('ss.title IN (:subscription_statuses)')
                ->setParameter('subscription_statuses', $subscriptionStatuses);
        }

        if ($plans = $params['plans'] ?? []) {
            $qb->andWhere('p.id IN (:plans)')
                ->setParameter('plans', $plans);
        }

        $qb->setFirstResult(($page - 1) * $offset);

        $qb->orderBy('u.created_at', 'DESC');

        return new Paginator($qb, true);
    }
}
