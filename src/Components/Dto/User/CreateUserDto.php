<?php


namespace App\Components\Dto\User;


use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateUserDto
{
    /**
     * @var $email string
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;
    /**
     * @var $password string
     * @Assert\NotNull()
     * @Assert\Length(min=8, max=32)
     */
    private $password;
    /**
     * @var $timezone string
     * @Assert\Timezone
     */
    private $timezone;
    /**
     * @var UuidInterface
     */
    private UuidInterface $uuid;

    public function __construct(
        UuidInterface $uuid,
        string $email,
        string $password,
        string $timezone,
        string $userType
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->timezone = $timezone;
        $this->userType = $userType;
        $this->uuid = $uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}
