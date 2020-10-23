<?php


namespace App\Components\Interactors\CRUD\Base;


use App\Components\Exceptions\DomainExceptions\Resource\EntityNotFoundException;
use App\Components\Helpers\Entity\Updater\EntityUpdaterInterface;
use App\Components\Interactors\InteractorInterface;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\IdentityInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractUpdateInteractor implements InteractorInterface
{
    private EntityUpdaterInterface $entityUpdater;
    private AbstractGetInteractor $entityGetter;
    private RepositoryInterface $repository;
    private ApplicationValidatorInterface $validator;

    public function __construct(
        EntityUpdaterInterface $entityUpdater,
        AbstractGetInteractor $entityGetter,
        RepositoryInterface $repository,
        ApplicationValidatorInterface $validator
    ) {
        $this->entityUpdater = $entityUpdater;
        $this->entityGetter = $entityGetter;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param mixed $dto
     *
     * @return IdentityInterface
     * @throws EntityNotFoundException
     */
    public function call($dto)
    {
        $this->validator->validate($dto);
        $entity = $this->entityGetter->call($dto->getId());
        $this->entityUpdater->update($entity, $dto);
        $this->validator->validate($entity);
        $this->repository->persist($entity);

        return $entity;
    }
}
