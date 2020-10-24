<?php


namespace App\Components\Interactors\CRUD\Base;


use App\Components\Helpers\Entity\Creator\EntityCreatorInterface;
use App\Components\Interactors\InteractorInterface;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractCreateInteractor implements InteractorInterface
{
    private EntityCreatorInterface $creator;
    private RepositoryInterface $repository;
    private ApplicationValidatorInterface $validator;

    public function __construct(
        EntityCreatorInterface $creator,
        RepositoryInterface $repository,
        ApplicationValidatorInterface $validator
    ) {
        $this->creator = $creator;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function call($dto)
    {
        $this->validator->validate($dto);
        $entity = $this->creator->create($dto);
        $this->validator->validate($entity);
        $this->repository->persist($entity);

        return $entity;
    }
}
