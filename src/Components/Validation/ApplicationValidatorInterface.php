<?php


namespace App\Components\Validation;


use App\Components\Exceptions\ApplicationExceptions\Resource\Validation\ValidationException;

interface ApplicationValidatorInterface
{
    /**
     * @param       $obj
     * @param array $validationGroups
     *
     * @throws ValidationException - throws exception if validation fail
     */
    public function validate($obj, array $validationGroups = ['Default']): void;
}
