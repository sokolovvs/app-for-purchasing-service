<?php


namespace App\Components\Helpers\Entity\Creator\User;


use App\Components\Dto\User\CreateUserDto;
use App\Components\Helpers\Entity\Creator\EntityCreatorInterface;
use App\Entity\User\Customer;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreator implements EntityCreatorInterface
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param CreateUserDto $dto
     *
     * @return User
     */
    public function create($dto)
    {
        if ($dto->getUserType() === Customer::class) {
            $user = new Customer($dto->getUuid(), $dto->getEmail(), $dto->getPassword(), $dto->getTimezone());
            $passwordHash = $this->passwordEncoder->encodePassword($user, $dto->getPassword());
            $user->setPasswordHash($passwordHash);

            return $user;
        }

        throw new \LogicException(__METHOD__ . ' Unknown user type for creating');
    }
}
