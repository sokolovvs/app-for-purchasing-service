<?php


namespace App\Components\Events\User\Customer;


use App\Components\Dto\EmailConfirm\AddEmailToConfirmDto;
use App\Components\Factories\Emails\Confirm\EmailConfirmMailFactory;
use App\Components\Interactors\CRUD\EmailConfirm\AddEmailToConfirm;
use App\Repository\User\CustomerRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CustomerWasRegisteredHandler implements MessageHandlerInterface
{
    private CustomerRepository $customerRepository;
    private AddEmailToConfirm $addEmailToConfirm;
    private EmailConfirmMailFactory $emailConfirmMailFactory;

    public function __construct(
        CustomerRepository $customerRepository,
        AddEmailToConfirm $addEmailToConfirm,
        EmailConfirmMailFactory $emailConfirmMailFactory
    ) {
        $this->customerRepository = $customerRepository;
        $this->addEmailToConfirm = $addEmailToConfirm;
        $this->emailConfirmMailFactory = $emailConfirmMailFactory;
    }

    public function __invoke(CustomerWasRegistered $message)
    {
        $customer = $this->customerRepository->getById($message->getCustomerUuid());
        $confirmationId = Uuid::uuid4();
        $hash = md5(microtime(true));
        $this->emailConfirmMailFactory->create($customer, $confirmationId)
            ->send();
        $this->addEmailToConfirm->call(new AddEmailToConfirmDto($confirmationId, $hash, $customer));

    }
}
