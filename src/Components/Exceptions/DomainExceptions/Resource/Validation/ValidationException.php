<?php


namespace App\Components\Exceptions\DomainExceptions\Resource\Validation;


use App\Components\Exceptions\DomainExceptions\ImproveDomainException;
use Throwable;

class ValidationException extends ImproveDomainException
{
    public function __construct(
        $message = 'Validation exception',
        Throwable $previous = null,
        array $invalidParams = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, $previous, $invalidParams, $additionalParams);
    }

    public static function fromErrors(array $errors = []): self
    {
        return new self('Validation exception', null, $errors);
    }
}
