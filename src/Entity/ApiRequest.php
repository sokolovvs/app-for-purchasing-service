<?php

namespace App\Entity;


use App\Repository\ApiRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ApiRequestRepository::class)
 */
class ApiRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Subscription::class, inversedBy="apiRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subscription;

    /**
     * @ORM\Column(type="json")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $called_at;

    public function __construct(UuidInterface $id, Subscription $subscription, array $content = [])
    {
        $this->id = $id;
        $this->subscription = $subscription;
        $this->content = $content;
        $this->called_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function getCalledAt(): \DateTimeInterface
    {
        return $this->called_at;
    }
}
