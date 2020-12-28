<?php


namespace App\Components\Helpers\Entity\Creator\EmailConfirm;


use App\Components\Dto\EmailConfirm\AddEmailToConfirmDto;
use App\Components\Helpers\Entity\Creator\EntityCreatorInterface;
use App\Entity\EmailConfirm;
use Ramsey\Uuid\Rfc4122\UuidV4;

class EmailConfirmCreator implements EntityCreatorInterface
{

    /**
     * @param AddEmailToConfirmDto $dto
     *
     * @return \App\Entity\IdentityInterface|EmailConfirm
     */
    public function create($dto)
    {
        return new EmailConfirm(UuidV4::uuid4(), $dto->getUser(), $dto->getHash());
    }
}
