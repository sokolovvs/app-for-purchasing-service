<?php

namespace App\Entity\User;


use App\Entity\IdentityInterface;
use App\Repository\User\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @MappedSuperclass
 * @InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements IdentityInterface, UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
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
     * @Assert\Timezone
     */
    private $timezone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct(UuidInterface $uuid, string $email, string $password_hash, string $timezone)
    {
        $this->id = $uuid;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->timezone = $timezone;
        $this->created_at = new \DateTimeImmutable();
        $this->isActive = false;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
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

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function changeActiveStatus(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->getPasswordHash();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {

    }
}
