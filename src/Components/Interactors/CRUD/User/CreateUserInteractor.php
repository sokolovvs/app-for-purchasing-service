<?php


namespace App\Components\Interactors\CRUD\User;


use App\Components\Dto\User\CreateUserDto;
use App\Components\Helpers\Entity\Creator\User\UserCreator;
use App\Components\Interactors\CRUD\Base\AbstractCreateInteractor;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\User\User;
use App\Repository\User\UserRepositoryInterface;

/**
 * Class CreateUserInteractor
 *
 * @package App\Components\Interactors\CRUD\User
 * @method User call(CreateUserDto $dto)
 */
final class CreateUserInteractor extends AbstractCreateInteractor
{
    public function __construct(
        UserCreator $creator,
        UserRepositoryInterface $repository,
        ApplicationValidatorInterface $validator
    ) {
        parent::__construct($creator, $repository, $validator);
    }
}
