<?php


namespace App\Components\Exceptions\ApplicationExceptions;


use Throwable;

class ImproveApplicationException extends \DomainException
{
    private array $invalidParams;
    private array $additionalParams;

    public function __construct(
        $message = 'Domain Exception',
        Throwable $previous = null,
        array $invalidParams = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, 0, $previous);
        $this->invalidParams = $invalidParams;
        $this->additionalParams = $additionalParams;
    }

    public function getInvalidParams(): array
    {
        return $this->invalidParams;
    }

    public function getAdditionalParams(): array
    {
        return $this->additionalParams;
    }
}
