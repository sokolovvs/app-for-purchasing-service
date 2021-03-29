<?php

namespace App\Entity;


use App\Entity\User\User;
use App\Repository\RefreshTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=RefreshTokenRepository::class)
 */
class RefreshToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="refreshTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    public function __construct(UuidInterface $id, User $user, string $token)
    {
        $this->id = $id;
        $this->_user = $user;
        $this->token = $token;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->_user;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
