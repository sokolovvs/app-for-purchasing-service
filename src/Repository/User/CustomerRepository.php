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
        $qb = $this->createQueryBuilder('u')
            //            ->innerJoin('u.Subscriptions', 's')
            //            ->innerJoin('s.Status', 'ss')
        ;

        //        if ($page = $params['page'] ?? 1) {
        //            $qb->;
        //        }

        return new Paginator($qb, true);
    }
}
