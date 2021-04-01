<?php


namespace App\Components\Interactors\CRUD\User;


use App\Repository\User\CustomerRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class GetCustomersInteractor
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function call(array $params): Paginator
    {
        return $this->customerRepository->getCustomersByParams($params);
    }
}
