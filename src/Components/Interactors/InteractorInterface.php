<?php


namespace App\Components\Interactors;


interface InteractorInterface
{
    /**
     * @param mixed $dto
     *
     * @return mixed
     */
    public function call($dto);
}
