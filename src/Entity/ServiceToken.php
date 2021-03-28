<?php

namespace App\Entity;


use App\Entity\User\Customer;
use App\Repository\ServiceTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ServiceTokenRepository::class)
 */
class ServiceToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8192)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $public_id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $_user;

    public function __construct(UuidInterface $id, string $token, string $publicId, Customer $user)
    {
        $this->id = $id;
        $this->token = $token;
        $this->public_id = $publicId;
        $this->_user = $user;
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getPublicId(): string
    {
        return $this->public_id;
    }

    public function getUser(): ?Customer
    {
        return $this->_user;
    }
}
