<?php


namespace App\Components\Validation;


use App\Components\Exceptions\ApplicationExceptions\Resource\Validation\ValidationException;

interface ApplicationValidatorInterface
{
    /**
     * @param mixed $obj
     *
     * @throws ValidationException - throws exception if validation fail
     */
    public function validate($obj): void;
}
