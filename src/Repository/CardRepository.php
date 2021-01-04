<?php

namespace App\Repository;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends AbstractDoctrineRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, $entityManager, Card::class);
    }

    /**
     * @param $id
     *
     * @return Card
     * @throws ResourceNotFoundException
     */
    public function getById($id): Card
    {
        $card = $this->find($id);

        if ($card === null) {
            throw new ResourceNotFoundException();
        }

        return $card;
    }
}
