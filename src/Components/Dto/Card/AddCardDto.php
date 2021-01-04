<?php


namespace App\Components\Dto\Card;


use App\Entity\User\User;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class AddCardDto
{
    private UuidInterface $id;
    private User $user;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $cryptogram;

    public function __construct(UuidInterface $id, User $user, $cryptogram)
    {
        $this->id = $id;
        $this->user = $user;
        $this->cryptogram = $cryptogram;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCryptogram(): string
    {
        return $this->cryptogram;
    }
}
