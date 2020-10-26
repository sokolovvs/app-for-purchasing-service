<?php

namespace App\Entity\User;


use App\Entity\IdentityInterface;
use App\Repository\User\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @MappedSuperclass
 * @InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="`user`")
 */
class User implements IdentityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password_hash;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timezone;

    /**
     * User constructor.
     *
     * @param $email
     * @param $password_hash
     * @param $timezone
     */
    public function __construct(string $email, string $password_hash, string $timezone)
    {
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->timezone = $timezone;
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }
}
