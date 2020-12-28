<?php


namespace App\Components\Interactors\Auth;


use App\Components\Exceptions\ApplicationExceptions\Security\UnauthorizedException;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AuthManager
{
    private $tokenStorage;

    public function __construct(
        TokenStorageInterface $storage,
    ) {
        $this->tokenStorage = $storage;
    }

    public function getCurrentUser(): ?User
    {
        $token = $this->tokenStorage->getToken();

        if ($token instanceof TokenStorageInterface) {
            /** @var User $user */
            $user = $token->getUser();

            return $user;
        }

        return null;
    }

    public function getCurrentUserOrThrowException(): User
    {
        return $this->getCurrentUser() ?? throw new UnauthorizedException();
    }
}
