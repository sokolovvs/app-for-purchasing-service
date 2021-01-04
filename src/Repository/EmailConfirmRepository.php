<?php

namespace App\Repository;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\EmailConfirm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmailConfirm|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailConfirm|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailConfirm[]    findAll()
 * @method EmailConfirm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailConfirmRepository extends AbstractDoctrineRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, $entityManager, EmailConfirm::class);
    }

    /**
     * @param $id
     *
     * @return EmailConfirm
     * @throws ResourceNotFoundException
     */
    public function getById($id): EmailConfirm
    {
        $confirmation = $this->find($id);

        if ($confirmation === null) {
            throw new ResourceNotFoundException();
        }

        return $confirmation;
    }
}
