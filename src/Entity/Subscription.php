<?php

namespace App\Entity;


use App\Entity\User\Customer;
use App\Entity\User\User;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $_user;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plan;

    /**
     * @ORM\ManyToOne(targetEntity=SubscriptionStatus::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expired_at;

    public function __construct(
        UuidInterface $id,
        Customer $user,
        Plan $plan,
        SubscriptionStatus $status,
        ?\DateTimeInterface $expiredAt = null
    ) {
        $this->id = $id;
        $this->_user = $user;
        $this->plan = $plan;
        $this->status = $status;
        $this->created_at = new \DateTime();
        $this->expired_at = $expiredAt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUser(): Customer
    {
        return $this->_user;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getStatus(): SubscriptionStatus
    {
        return $this->status;
    }

    public function setStatus(SubscriptionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expired_at;
    }

    public function setExpiredAt(\DateTimeInterface $expiredAt): self
    {
        $this->expired_at = $expiredAt;

        return $this;
    }
}
