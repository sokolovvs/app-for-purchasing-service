<?php


namespace App\Components\Dto\EmailConfirm;


use App\Entity\User\User;

final class AddEmailToConfirmDto
{
    private string $hash;
    private User $user;

    public function __construct(string $hash, User $user)
    {
        $this->hash = $hash;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
