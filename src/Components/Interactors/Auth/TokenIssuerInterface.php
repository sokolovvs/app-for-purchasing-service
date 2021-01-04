<?php


namespace App\Components\Interactors\Auth;


use App\Entity\User\User;

interface TokenIssuerInterface
{
    public function fromPayload(array $payload): string;

    public function fromUser(User $user): string;
}
