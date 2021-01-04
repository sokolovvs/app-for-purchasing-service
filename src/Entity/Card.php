<?php

namespace App\Entity;

use App\Entity\User\User;
use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cardToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first4;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $holderName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expiredAt;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->_user;
    }

    public function setUser(?User $_user): self
    {
        $this->_user = $_user;

        return $this;
    }

    public function getCardToken(): ?string
    {
        return $this->cardToken;
    }

    public function setCardToken(?string $cardToken): self
    {
        $this->cardToken = $cardToken;

        return $this;
    }

    public function getLast6(): ?string
    {
        return $this->last6;
    }

    public function setLast6(?string $last6): self
    {
        $this->last6 = $last6;

        return $this;
    }

    public function getFirst4(): ?string
    {
        return $this->first4;
    }

    public function setFirst4(?string $first4): self
    {
        $this->first4 = $first4;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getHolderName(): ?string
    {
        return $this->holderName;
    }

    public function setHolderName(?string $holderName): self
    {
        $this->holderName = $holderName;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }
}
