<?php


namespace App\Components\Events\User\Customer;


use Ramsey\Uuid\UuidInterface;

class CustomerWasRegistered
{
    private UuidInterface $customerUuid;

    public function __construct(UuidInterface $customerUuid)
    {
        $this->customerUuid = $customerUuid;
    }

    public function getCustomerUuid(): UuidInterface
    {
        return $this->customerUuid;
    }
}
