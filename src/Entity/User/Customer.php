<?php


namespace App\Entity\User;


use App\Entity\Subscription;
use App\Repository\User\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer extends User
{
    /**
     * @ORM\OneToMany(targetEntity=Subscription::class, mappedBy="_user", orphanRemoval=true)
     */
    private $subscriptions;

    public function __construct(UuidInterface $uuid, string $email, string $passwordHash, string $timezone)
    {
        parent::__construct($uuid, $email, $passwordHash, $timezone);
        $this->subscriptions = new ArrayCollection();
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setUser($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getUser() === $this) {
                $subscription->setUser(null);
            }
        }

        return $this;
    }
}
