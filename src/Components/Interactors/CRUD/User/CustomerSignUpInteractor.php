<?php


namespace App\Components\Interactors\CRUD\User;


use App\Components\Dto\User\ClientSignUpDto;
use App\Components\Dto\User\CreateUserDto;
use App\Components\Events\User\Customer\CustomerWasRegistered;
use App\Components\TransactionScripts\RelationalDbTransaction;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\User\Customer;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Symfony\Component\Messenger\MessageBusInterface;

final class CustomerSignUpInteractor
{
    private RelationalDbTransaction $dbTransaction;

    private ApplicationValidatorInterface $validator;

    private MessageBusInterface $eventBus;

    public function __construct(
        CreateUserInteractor $createUser,
        RelationalDbTransaction $dbTransaction,
        ApplicationValidatorInterface $validator,
        MessageBusInterface $eventBus
    ) {
        $this->createUser = $createUser;
        $this->dbTransaction = $dbTransaction;
        $this->validator = $validator;
        $this->eventBus = $eventBus;
    }

    public function call(ClientSignUpDto $dto): void
    {
        $this->validator->validate($dto);
        $uuid = UuidV4::uuid4();

        $this->dbTransaction->transactional(
            [$this->createUser, 'call'],
            [
                new CreateUserDto(
                    $uuid, $dto->getEmail(), $dto->getPassword(), $dto->getTimezone(), Customer::class
                ),
            ]
        );

        $this->eventBus->dispatch(new CustomerWasRegistered($uuid));
    }
}
