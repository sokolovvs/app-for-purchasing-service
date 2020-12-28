<?php


namespace App\Repository\User;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\User\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CustomerRepository
 *
 * @package App\Repository\User
 */
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
}
