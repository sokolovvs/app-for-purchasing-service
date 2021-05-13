<?php


namespace App\Components\Helpers\Exception;


class ExceptionFormatter
{
    public static function format(\Throwable $e) : string{
        return sprintf("%s%s%s", $e->getMessage(), PHP_EOL, $e->getTraceAsString());
    }
}
