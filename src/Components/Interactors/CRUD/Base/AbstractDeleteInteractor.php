<?php


namespace App\Components\Interactors\CRUD\Base;


use App\Components\Exceptions\DomainExceptions\Resource\EntityNotFoundException;
use App\Components\Interactors\InteractorInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractDeleteInteractor implements InteractorInterface
{
    private AbstractGetInteractor $getInteractor;
    private RepositoryInterface $repository;

    public function __construct(AbstractGetInteractor $getInteractor, RepositoryInterface $repository)
    {
        $this->getInteractor = $getInteractor;
        $this->repository = $repository;
    }

    /**
     * @param int|string $id - entity id
     *
     * @return void
     * @throws EntityNotFoundException
     */
    public function call($id)
    {
        $entity = $this->getInteractor->call($id);

        $this->repository->remove($entity);
    }
}
