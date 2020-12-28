<?php


namespace App\Components\Dto\User;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class ClientSignUpDto
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

    public function __construct($email, $password, $timezone)
    {
        $this->email = $email;
        $this->password = $password;
        $this->timezone = $timezone;
    }

    public static function fromHttpRequest(Request $request): self
    {
        return new self(
            $request->request->get('email'), $request->request->get('password'), $request->request->get('timezone'),
        );
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
}
