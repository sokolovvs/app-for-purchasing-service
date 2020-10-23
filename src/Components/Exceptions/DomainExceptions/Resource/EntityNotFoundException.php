<?php


namespace App\Components\Exceptions\DomainExceptions\Resource;


use App\Components\Exceptions\DomainExceptions\ImproveDomainException;
use Throwable;

class EntityNotFoundException extends ImproveDomainException
{
    public function __construct(
        $message = 'Resource not found',
        Throwable $previous = null,
        array $invalidParams = [],
        array $additionalParams = []
    ) {
        parent::__construct($message, $previous, $invalidParams, $additionalParams);
    }
}
