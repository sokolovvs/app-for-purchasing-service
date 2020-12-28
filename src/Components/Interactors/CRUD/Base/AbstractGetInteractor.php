<?php


namespace App\Components\Interactors\CRUD\Base;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\IdentityInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractGetInteractor
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
     * @throws ResourceNotFoundException
     */
    public function call($id)
    {
        $entity = $this->repository->findById($id);

        if ($entity === null) {
            throw new ResourceNotFoundException();
        }

        return $entity;
    }
}
