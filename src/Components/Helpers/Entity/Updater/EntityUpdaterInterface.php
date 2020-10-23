<?php


namespace App\Components\Helpers\Entity\Updater;


use App\Entity\IdentityInterface;

interface EntityUpdaterInterface
{
    /**
     * @param IdentityInterface $entity
     * @param mixed             $dto
     */
    public function update(IdentityInterface $entity, $dto);
}
