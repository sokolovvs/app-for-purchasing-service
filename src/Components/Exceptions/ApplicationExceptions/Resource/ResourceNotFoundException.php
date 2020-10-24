<?php


namespace App\Components\Exceptions\ApplicationExceptions\Resource;


use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;
use Throwable;

class ResourceNotFoundException extends ImproveApplicationException
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
