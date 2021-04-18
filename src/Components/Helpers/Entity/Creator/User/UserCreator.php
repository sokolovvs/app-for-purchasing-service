<?php


namespace App\Components\Helpers\Entity\Creator\User;


use App\Components\Dto\User\CreateUserDto;
use App\Components\Helpers\Entity\Creator\EntityCreatorInterface;
use App\Components\Interactors\Auth\PasswordHasher;
use App\Entity\User\Admin;
use App\Entity\User\Customer;
use App\Entity\User\User;
use LogicException;

class UserCreator implements EntityCreatorInterface
{
    private PasswordHasher $passwordHasher;

    public function __construct(PasswordHasher $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param CreateUserDto $dto
     *
     * @return User
     */
    public function create($dto)
    {
        if ($dto->getUserType() === Customer::class) {
            return new Customer(
                $dto->getUuid(), $dto->getEmail(), $this->passwordHasher->encodePassword($dto->getPassword()),
                $dto->getTimezone()
            );
        }

        if ($dto->getUserType() === Admin::class) {
            return new Admin(
                $dto->getUuid(), $dto->getEmail(), $this->passwordHasher->encodePassword($dto->getPassword()),
                $dto->getTimezone(), $dto->isActive()
            );
        }

        throw new LogicException(__METHOD__ . ' Unknown user type for creating');
    }
}
