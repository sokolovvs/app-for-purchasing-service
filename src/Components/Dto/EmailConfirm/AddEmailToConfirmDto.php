<?php


namespace App\Components\Dto\EmailConfirm;


use App\Entity\User\User;
use Ramsey\Uuid\UuidInterface;

final class AddEmailToConfirmDto
{
    private string $hash;
    private User $user;
    private UuidInterface $uuid;

    public function __construct(UuidInterface $uuid, string $hash, User $user)
    {
        $this->hash = $hash;
        $this->user = $user;
        $this->uuid = $uuid;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}
