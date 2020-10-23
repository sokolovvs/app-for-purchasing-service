<?php


namespace App\Components\Validation;


use App\Components\Exceptions\DomainExceptions\Resource\Validation\ValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AspectOrientedValidator implements ApplicationValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param          $object
     * @param string[] $group
     *
     * @throws ValidationException
     */
    public function validate($object, array $group = ['Default']): void
    {
        $errors = $this->validator->validate($object, null, $group);

        if ($errors->count() > 0) {
            $errors = $this->getErrors($errors);
            throw ValidationException::fromErrors($errors);
        }
    }

    private function getErrors(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];

        foreach ($violationList as $violation) {
            $field = $violation->getPropertyPath();
            $message = $violation->getMessage();
            $errors[$field][] = $message;
        }

        return $errors;
    }
}
