<?php

namespace App\Components\Dto\Requests;


use DateTime;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class AddTpsApiRequestDto
{
    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $publicId;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $secret;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $content;

    private DateTimeInterface $calledAt;

    public function __construct($publicId, $secret, $content)
    {
        $this->publicId = $publicId;
        $this->secret = $secret;
        $this->content = $content;
        $this->calledAt = new DateTime();
    }

    public function getPublicId(): string
    {
        return $this->publicId;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public static function fromHttpRequest(Request $request): self
    {
        return new self(
            $request->headers->get("tps-public-id", ""),
            $request->headers->get("tps-secret", ""),
            $request->getContent()
        );
    }

    public function getCalledAt(): DateTimeInterface
    {
        return $this->calledAt;
    }
}
