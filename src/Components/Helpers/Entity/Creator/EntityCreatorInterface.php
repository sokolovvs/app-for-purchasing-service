<?php


namespace App\Components\Helpers\Entity\Creator;


use App\Entity\IdentityInterface;

interface EntityCreatorInterface
{
    /**
     * @param mixed $dto
     *
     * @return IdentityInterface
     */
    public function create($dto);
}
