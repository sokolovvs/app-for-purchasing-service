<?php

namespace App\Components\Events\ApiTpsRequest;


use App\Entity\ApiRequest;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ClientRequestedTpsApiHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private SubscriptionRepository $subscriptionRepository;
    private LoggerInterface $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        SubscriptionRepository $subscriptionRepository,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->logger = $logger;
    }

    public function __invoke(ClientRequestedTpsApi $event)
    {
        $subscription = $this->subscriptionRepository->find($event->getSubscriptionId());

        if (!$subscription) {
            $this->logger->warning(
                "Can not add request because of subscription with id {$event->getSubscriptionId()} is not exists"
            );

            return;
        }

        $apiRequest = new ApiRequest(
            Uuid::uuid4(), $subscription, $event->getCalledAt(),
            json_decode($event->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );
        $this->entityManager->persist($apiRequest);
        $this->entityManager->flush();
    }
}
