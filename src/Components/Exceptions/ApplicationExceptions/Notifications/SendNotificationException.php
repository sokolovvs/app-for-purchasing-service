<?php


namespace App\Components\Exceptions\ApplicationExceptions\Notifications;


use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;

class SendNotificationException extends ImproveApplicationException
{
    public static function fromInvalidParams(array $invalidParams): self
    {
        return new self('Send mail error', null, $invalidParams);
    }
}
