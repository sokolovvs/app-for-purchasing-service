<?php


namespace App\Components\Interactors\Auth;


class PasswordHasher
{
    private string $algo;

    public function __construct($algo = PASSWORD_ARGON2I)
    {
        $this->algo = $algo;
    }

    public function encodePassword(string $password): string
    {
        return password_hash($password, $this->algo);
    }
}
