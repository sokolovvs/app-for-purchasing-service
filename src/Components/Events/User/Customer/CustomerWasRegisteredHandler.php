<?php


namespace App\Components\Events\User\Customer;


use App\Components\Dto\EmailConfirm\AddEmailToConfirmDto;
use App\Components\Interactors\CRUD\EmailConfirm\AddEmailToConfirm;
use App\Components\Notifications\Mail\Mails\EmailConfirmMail;
use App\Components\Notifications\Mail\MailService\MailerService;
use App\Entity\EmailConfirm;
use App\Repository\User\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CustomerWasRegisteredHandler implements MessageHandlerInterface
{
    private CustomerRepository $customerRepository;
    private MailerService $mailerService;
    private AddEmailToConfirm $addEmailToConfirm;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(
        CustomerRepository $customerRepository,
        MailerService $mailerService,
        AddEmailToConfirm $addEmailToConfirm,
        EntityManagerInterface $entityManager
    ) {
        $this->customerRepository = $customerRepository;
        $this->mailerService = $mailerService;
        $this->addEmailToConfirm = $addEmailToConfirm;
        $this->entityManager = $entityManager;
    }

    public function __invoke(CustomerWasRegistered $message)
    {
        $customer = $this->customerRepository->getById($message->getCustomerUuid());
        $emailToConfirm = $this->addEmailToConfirm->call(new AddEmailToConfirmDto(md5(microtime(true)), $customer));

        (new EmailConfirmMail(
            $this->mailerService, $customer->getEmail(), $customer, $emailToConfirm
        ))->send();
    }
}
