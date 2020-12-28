<?php


namespace App\Components\TransactionScripts;


use Doctrine\ORM\EntityManagerInterface;

class RelationalDbTransaction implements ApplicationTransactionInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }

    public function transactional(callable $callable, array $args = []): void
    {
        $this->beginTransaction();

        try {
            if (is_array($callable)) {
                call_user_func_array($callable, $args);
            } else {
                $callable(...$args);
            }
            $this->commit();
        } catch (\Throwable $throwable) {
            $this->rollback();
            throw $throwable;
        }
    }
}
