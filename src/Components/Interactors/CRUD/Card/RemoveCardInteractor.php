<?php


namespace App\Components\Interactors\CRUD\Card;


use App\Components\Dto\Card\RemoveCardDto;
use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;

final class RemoveCardInteractor
{
    private CardRepository $cardRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CardRepository $cardRepository, EntityManagerInterface $entityManager)
    {
        $this->cardRepository = $cardRepository;
        $this->entityManager = $entityManager;
    }

    public function call(RemoveCardDto $dto): void
    {
        $card = $this->cardRepository->getById($dto->getCardId());

        if ($card->getUser()->getId() !== $dto->getUserId()) {
            throw new ResourceNotFoundException();
        }

        $this->entityManager->remove($card);
        $this->entityManager->flush();
    }
}
