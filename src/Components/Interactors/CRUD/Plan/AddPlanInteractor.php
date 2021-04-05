<?php

namespace App\Components\Interactors\CRUD\Plan;


use App\Components\Dto\Plan\AddPlanDto;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\Plan;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class AddPlanInteractor
{
    private EntityManagerInterface $entityManager;
    private ApplicationValidatorInterface $validator;

    public function __construct(EntityManagerInterface $entityManager, ApplicationValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param AddPlanDto $dto
     *
     * @return Plan
     */
    public function call($dto)
    {
        $this->validator->validate($dto);

        $plan = new Plan(
            Uuid::fromString($dto->getId()), $dto->isActive(), $dto->getAmount(), $dto->getPeriod(),
            $dto->getTitle(), $dto->getDescription()
        );

        $this->validator->validate($plan);

        $this->entityManager->persist($plan);
        $this->entityManager->flush();

        return $plan;
    }
}
