<?php


namespace App\Components\Exceptions\ApplicationExceptions;


use Exception;
use Throwable;

class ImproveApplicationException extends Exception
{
    private array $invalidParams;
    private array $additionalParams;

    public function __construct(
        $message = 'Application Exception',
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
