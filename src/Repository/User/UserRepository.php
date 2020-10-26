<?php

namespace App\Repository\User;


use App\Entity\User\User;
use App\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class UserRepository extends AbstractDoctrineRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, $entityManager, User::class);
    }
}
