<?php


namespace App\Components\Exceptions\ApplicationExceptions\Security;


use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;
use Throwable;

class SecurityException extends ImproveApplicationException
{
    public function __construct(
        $message = 'Security Exception',
        Throwable $previous = null,
        array $invalidParams = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, $previous, $invalidParams, $additionalParams);
    }
}
