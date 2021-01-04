<?php


namespace App\Components\Helpers\Entity\Creator\Card;


use App\Components\Helpers\Entity\Creator\EntityCreatorInterface;
use App\Entity\Card;

/**
 * Class CardCreator
 *
 * @package App\Components\Helpers\Entity\Creator\Card
 */
class CardCreator implements EntityCreatorInterface
{

    /**
     * @param mixed $dto
     *
     * @return \App\Entity\Card
     */
    public function create($dto)
    {
//        return new Card($);
    }
}
