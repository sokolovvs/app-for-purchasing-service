<?php


namespace App\Components\Exceptions\ApplicationExceptions\Resource\Validation;


use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;
use Throwable;

class ValidationException extends ImproveApplicationException
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
