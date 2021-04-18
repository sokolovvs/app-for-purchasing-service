<?php


namespace App\Entity\User;


use App\Repository\User\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin extends User
{
    public function __construct(
        UuidInterface $uuid,
        string $email,
        string $passwordHash,
        string $timezone,
        bool $isActive = true
    ) {
        parent::__construct($uuid, $email, $passwordHash, $timezone);
        $this->isActive = $isActive;
    }
}
