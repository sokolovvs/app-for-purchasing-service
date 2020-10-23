<?php


namespace App\Components\Interactors\CRUD\Base;


use App\Components\Exceptions\DomainExceptions\Resource\EntityNotFoundException;
use App\Components\Interactors\InteractorInterface;
use App\Entity\IdentityInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractGetInteractor implements InteractorInterface
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|string $id entity id
     *
     * @return IdentityInterface|object
     * @throws EntityNotFoundException
     */
    public function call($id)
    {
        $entity = $this->repository->find($id);

        if ($entity === null) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }
}
