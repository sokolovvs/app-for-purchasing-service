<?php

namespace App\Components\Events\ApiTpsRequest;


use DateTimeInterface;
use Ramsey\Uuid\UuidInterface;

class ClientRequestedTpsApi
{
    private UuidInterface $subscriptionId;
    private string $content;
    private DateTimeInterface $calledAt;

    public function __construct(UuidInterface $subscriptionId, string $content, DateTimeInterface $calledAt)
    {
        $this->subscriptionId = $subscriptionId;
        $this->content = $content;
        $this->calledAt = $calledAt;
    }

    public function getSubscriptionId(): UuidInterface
    {
        return $this->subscriptionId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCalledAt(): DateTimeInterface
    {
        return $this->calledAt;
    }
}
