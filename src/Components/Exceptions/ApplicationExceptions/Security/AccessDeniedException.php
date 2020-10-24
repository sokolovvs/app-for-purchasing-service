<?php


namespace App\Components\Exceptions\ApplicationExceptions\Security;


use Throwable;

class AccessDeniedException extends SecurityException
{
    public function __construct(
        $message = 'Access denied',
        Throwable $previous = null,
        array $errors = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, $previous, $errors, $additionalParams);
    }
}
