<?php


namespace App\Components\TransactionScripts;


interface ApplicationTransactionInterface
{
    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;

    /**
     * @param callable $callable
     * @param array    $args
     *
     * @throws \Throwable
     */
    public function transactional(callable $callable, array $args = []): void;
}
