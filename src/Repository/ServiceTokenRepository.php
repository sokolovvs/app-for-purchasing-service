<?php

namespace App\Repository;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\ServiceToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceToken[]    findAll()
 * @method ServiceToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceToken::class);
    }

    /**
     * @param string $publicId
     * @param string $secret
     *
     * @return ServiceToken
     * @throws ResourceNotFoundException
     */
    public function getByPublicIdAndToken(string $publicId, string $secret): ServiceToken
    {
        $token = $this->findOneBy(['public_id' => $publicId, 'token' => $secret]);

        if ($token === null) {
            throw new ResourceNotFoundException(
                "token is not exists in db with params public_id: $publicId and token: $secret"
            );
        }

        return $token;
    }
}
