<?php

namespace App\Entity;


use App\Entity\User\Customer;
use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=SubscriptionHistory::class, mappedBy="subscription", orphanRemoval=true)
     */
    private $subscriptionHistories;

    /**
     * @ORM\OneToMany(targetEntity=ApiRequest::class, mappedBy="subscription", orphanRemoval=true)
     */
    private $apiRequests;

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
        $this->subscriptionHistories = new ArrayCollection();
        $this->apiRequests = new ArrayCollection();
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

    /**
     * @return Collection|SubscriptionHistory[]
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): self
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories[] = $subscriptionHistory;
            $subscriptionHistory->setSubscription($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): self
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getSubscription() === $this) {
                $subscriptionHistory->setSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApiRequest[]
     */
    public function getApiRequests(): Collection
    {
        return $this->apiRequests;
    }

    public function addApiRequest(ApiRequest $apiRequest): self
    {
        if (!$this->apiRequests->contains($apiRequest)) {
            $this->apiRequests[] = $apiRequest;
            $apiRequest->setSubscription($this);
        }

        return $this;
    }

    public function removeApiRequest(ApiRequest $apiRequest): self
    {
        if ($this->apiRequests->removeElement($apiRequest)) {
            // set the owning side to null (unless already changed)
            if ($apiRequest->getSubscription() === $this) {
                $apiRequest->setSubscription(null);
            }
        }

        return $this;
    }
}
