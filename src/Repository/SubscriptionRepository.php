<?php

namespace App\Repository;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Entity\Subscription;
use App\Entity\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscription[]    findAll()
 * @method Subscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    /**
     * @param User $user
     *
     * @return Subscription
     * @throws ResourceNotFoundException
     */
    public function getActiveSubscriptionByUser(User $user): Subscription
    {
        $subscription = $this->findOneBy(['_user' => $user,]);

        if ($subscription === null
            || $subscription->getStatus()->getTitle()
            !== "Active") { // TODO: refactor this later
            throw new ResourceNotFoundException("User with id {$user->getId()} has no active subscriptions");
        }

        return $subscription;
    }
}
