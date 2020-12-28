<?php

namespace App\Entity;


use App\Entity\User\User;
use App\Repository\EmailConfirmRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=EmailConfirmRepository::class)
 */
class EmailConfirm
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    public function __construct(UuidInterface $id, User $_user, string $hash)
    {
        $this->id = $id;
        $this->_user = $_user;
        $this->hash = $hash;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->_user;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
