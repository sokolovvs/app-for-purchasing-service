<?php


namespace App\Components\Interactors\CRUD\EmailConfirm;


use App\Components\TransactionScripts\RelationalDbTransaction;
use App\Repository\EmailConfirmRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ConfirmEmail
{
    private EmailConfirmRepository $emailConfirmRepository;
    private EntityManagerInterface $entityManager;
    private RelationalDbTransaction $dbTransaction;

    public function __construct(
        EmailConfirmRepository $emailConfirmRepository,
        EntityManagerInterface $entityManager,
        RelationalDbTransaction $dbTransaction
    ) {
        $this->emailConfirmRepository = $emailConfirmRepository;
        $this->entityManager = $entityManager;
        $this->dbTransaction = $dbTransaction;
    }

    public function call(string $code): void
    {
        $this->dbTransaction->transactional(
            function () use ($code) {
                $confirm = $this->emailConfirmRepository->getById($code);
                $user = $confirm->getUser();
                $user->setActiveStatus(true);
                $this->entityManager->remove($confirm);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }
        );
    }
}
