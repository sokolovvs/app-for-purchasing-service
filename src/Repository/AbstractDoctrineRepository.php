<?php


namespace App\Repository;


use App\Entity\IdentityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractDoctrineRepository extends ServiceEntityRepository implements RepositoryInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager,
        string $entityMappingClassName
    ) {
        parent::__construct($registry, $entityMappingClassName);
        $this->entityManager = $entityManager;
    }

    /**
     * @param $id
     *
     * @return IdentityInterface|object|null
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * @param IdentityInterface $entity
     */
    public function persist($entity): void
    {
        $this->entityManager->persist($entity);
    }

    /**
     * @param IdentityInterface $entity
     */
    public function remove($entity): void
    {
        $this->entityManager->persist($entity);
    }
}
