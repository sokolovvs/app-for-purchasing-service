<?php


namespace App\Components\Interactors\CRUD\EmailConfirm;


use App\Components\Dto\EmailConfirm\ConfrimEmailDto;
use App\Repository\EmailConfirmRepository;
use App\Entity\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

final class ConfirmEmail
{
    private EmailConfirmRepository $emailConfirmRepository;

    public function __construct(
        EmailConfirmRepository $emailConfirmRepository,
    ) {
        $this->emailConfirmRepository = $emailConfirmRepository;
    }

    public function call(ConfrimEmailDto $dto): UserInterface|User
    {
        $confirm = $this->emailConfirmRepository->findConfirmEmail($dto);

        return $confirm->getUser();
    }
}
