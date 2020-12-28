<?php


namespace App\Entity;


use Ramsey\Uuid\UuidInterface;

interface IdentityInterface
{
    /**
     * @return int|UuidInterface|null
     */
    public function getId();
}
