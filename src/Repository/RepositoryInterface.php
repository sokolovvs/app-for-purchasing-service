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
     * @return object
     */
    public function find($id);

    /**
     * @return object[]
     */
    public function findAll();
}
