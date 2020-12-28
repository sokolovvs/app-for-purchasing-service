<?php


namespace App\Components\Helpers\Env;


final class EnvHelper
{
    public static function getValue(string $key, $default = null): string|bool|int|float|null
    {
        return $_ENV[$key] ?? $default;
    }
}
