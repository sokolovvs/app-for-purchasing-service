<?php


namespace App\Components\Exceptions\DomainExceptions\Security;


use App\Components\Exceptions\DomainExceptions\ImproveDomainException;
use Throwable;

class SecurityException extends ImproveDomainException
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
