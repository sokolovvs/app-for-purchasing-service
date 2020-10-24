<?php


namespace App\Components\Exceptions\ApplicationExceptions\Security;


use Throwable;

class UnauthorizedException extends SecurityException
{
    public function __construct(
        $message = 'Unauthorized',
        Throwable $previous = null,
        array $errors = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, $previous, $errors, $additionalParams);
    }

    public static function invalidCredentials(string $message = 'Invalid pair login and password')
    {
        return new self($message);
    }
}
