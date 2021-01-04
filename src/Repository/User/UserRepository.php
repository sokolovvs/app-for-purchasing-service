<?php

namespace App\Repository\User;


use App\Entity\User\User;
use App\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


/**
 * Class UserRepository
 *
 * @package App\Repository\User
 * @method User|null findById($id)
 */
class UserRepository extends AbstractDoctrineRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, $entityManager, User::class);
    }

    /**
     * @param string $email
     *
     * @return User|object|null
     */
    public function findActiveByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email, 'isActive' => true]);
    }
}
