<?php


namespace App\Components\Interactors\CRUD\EmailConfirm;


use App\Components\Dto\EmailConfirm\AddEmailToConfirmDto;
use App\Components\Helpers\Entity\Creator\EmailConfirm\EmailConfirmCreator;
use App\Components\Interactors\CRUD\Base\AbstractCreateInteractor;
use App\Components\TransactionScripts\RelationalDbTransaction;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\EmailConfirm;
use App\Repository\User\UserRepository;

/**
 * Class AddEmailToConfirm
 *
 * @package App\Components\Interactors\CRUD\EmailConfirm
 */
final class AddEmailToConfirm extends AbstractCreateInteractor
{
    /**
     * @var RelationalDbTransaction
     */
    private RelationalDbTransaction $dbTransaction;

    public function __construct(
        EmailConfirmCreator $creator,
        UserRepository $repository,
        ApplicationValidatorInterface $validator,
        RelationalDbTransaction $dbTransaction
    ) {
        parent::__construct($creator, $repository, $validator);
        $this->dbTransaction = $dbTransaction;
    }

    /**
     * @param AddEmailToConfirmDto $dto
     *
     * @return \App\Entity\IdentityInterface|EmailConfirm
     * @throws \Throwable
     */
    public function call($dto)
    {
        $this->dbTransaction->beginTransaction();
        try {
            $confirm = parent::call($dto);
            $this->dbTransaction->commit();

            return $confirm;
        } catch (\Throwable $throwable) {
            $this->dbTransaction->rollback();
            throw  $throwable;
        }
    }
}
