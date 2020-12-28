<?php

namespace App\Repository;


use App\Components\Dto\EmailConfirm\ConfrimEmailDto;
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
class EmailConfirmRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailConfirm::class);
    }

    public function findConfirmEmail(ConfrimEmailDto $dto): EmailConfirm
    {
        $confirm = $this->findOneBy(
            ['id' => $dto->getEmailId(), '_user' => $dto->getUserId(), 'hash' => $dto->getHash()]
        );

        if ($confirm !== null) {
            return $confirm;
        }

        throw new ResourceNotFoundException();
    }
}
