<?php


namespace App\Repository;


use App\Entity\IdentityInterface;

interface RepositoryInterface
{
    public function persist(IdentityInterface $entity): void;

    public function remove(IdentityInterface $entity): void;

    /**
     * @param string|int $id
     *
     * @return IdentityInterface|object
     */
    public function find($id);

    /**
     * @return IdentityInterface[]|object[]
     */
    public function findAll();
}
