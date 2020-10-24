<?php


namespace App\Components\TransactionScripts\TransactionScripts;


use App\Components\Interactors\InteractorInterface;
use App\Components\TransactionScripts\ApplicationTransactionInterface;

abstract class AbstractTransactionScript implements InteractorInterface
{
    private InteractorInterface $interactor;
    private ApplicationTransactionInterface $applicationTransaction;

    public function __construct(
        InteractorInterface $interactor,
        ApplicationTransactionInterface $applicationTransaction
    ) {
        $this->interactor = $interactor;
        $this->applicationTransaction = $applicationTransaction;
    }

    public function call($dto)
    {
        $this->applicationTransaction->beginTransaction();

        try {
            $result = $this->interactor->call($dto);
            $this->applicationTransaction->commit();

            return $result;
        } catch (\Throwable $throwable) {
            $this->applicationTransaction->rollback();
            throw $throwable;
        }
    }
}
