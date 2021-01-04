<?php


namespace App\Components\Dto\Card;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class RemoveCardDto
{
    /**
     * @Assert\Uuid
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $userId;

    /**
     * @Assert\Uuid
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $cardId;

    public function __construct($userId, $cardId)
    {
        $this->userId = $userId;
        $this->cardId = $cardId;
    }

    /**
     * @return UuidInterface
     */
    public function getUserId()
    {
        return Uuid::fromString($this->userId);
    }

    /**
     * @return UuidInterface
     */
    public function getCardId()
    {
        return Uuid::fromString($this->cardId);
    }
}
