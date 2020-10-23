<?php


namespace App\Components\TransactionScripts;


interface ApplicationTransactionInterface
{
    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;
}
