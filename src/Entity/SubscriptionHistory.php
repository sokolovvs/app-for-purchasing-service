<?php

namespace App\Entity;


use App\Repository\SubscriptionHistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=SubscriptionHistoryRepository::class)
 */
class SubscriptionHistory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Subscription::class, inversedBy="subscriptionHistories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subscription;

    /**
     * @ORM\ManyToOne(targetEntity=SubscriptionStatus::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    public function __construct(UuidInterface $id, Subscription $subscription, SubscriptionStatus $status)
    {
        $this->id = $id;
        $this->subscription = $subscription;
        $this->status = $status;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    public function getStatus(): SubscriptionStatus
    {
        return $this->status;
    }
}
