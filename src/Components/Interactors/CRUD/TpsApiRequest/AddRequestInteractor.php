<?php

namespace App\Components\Interactors\CRUD\TpsApiRequest;


use App\Components\Dto\Requests\AddTpsApiRequestDto;
use App\Components\Events\ApiTpsRequest\ClientRequestedTpsApi;
use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Exceptions\ApplicationExceptions\Resource\Validation\ValidationException;
use App\Components\Exceptions\ApplicationExceptions\Security\AccessDeniedException;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Repository\ServiceTokenRepository;
use App\Repository\SubscriptionRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AddRequestInteractor
{
    private ApplicationValidatorInterface $validator;
    private ServiceTokenRepository $serviceTokenRepository;
    private SubscriptionRepository $subscriptionRepository;
    private MessageBusInterface $eventBus;
    private LoggerInterface $logger;

    public function __construct(
        ApplicationValidatorInterface $validator,
        ServiceTokenRepository $serviceTokenRepository,
        SubscriptionRepository $subscriptionRepository,
        MessageBusInterface $eventBus,
        LoggerInterface $logger
    ) {
        $this->validator = $validator;
        $this->serviceTokenRepository = $serviceTokenRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->eventBus = $eventBus;
        $this->logger = $logger;
    }

    /**
     * @param AddTpsApiRequestDto $dto
     *
     * @return void
     * @throws AccessDeniedException
     */
    public function call($dto)
    {
        try {
            $this->validator->validate($dto);
            $serviceToken = $this->serviceTokenRepository->getByPublicIdAndToken(
                $dto->getPublicId(),
                $dto->getSecret()
            );
            $customer = $serviceToken->getUser();
            $subscription = $this->subscriptionRepository->getActiveSubscriptionByUser($customer);
            $plan = $subscription->getPlan();
            //TODO: check plan's restrictions

            $this->eventBus->dispatch(
                new ClientRequestedTpsApi($subscription->getId(), $dto->getContent(), $dto->getCalledAt())
            );
        } catch (ResourceNotFoundException | ValidationException $exception) {
            $this->logger->error(sprintf("%s%s%s", $exception->getMessage(), PHP_EOL, $exception->getTraceAsString()));
            throw new AccessDeniedException('Access denied', $exception);
        }
    }
}
