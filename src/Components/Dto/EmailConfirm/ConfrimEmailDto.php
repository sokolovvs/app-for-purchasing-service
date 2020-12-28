<?php


namespace App\Components\Dto\EmailConfirm;


use Ramsey\Uuid\Uuid;

final class ConfrimEmailDto
{
    private $userId;
    private $emailId;
    private $hash;

    public function __construct($userId, $emailId, $hash)
    {
        $this->userId = $userId;
        $this->emailId = $emailId;
        $this->hash = $hash;
    }

    public function getUserId()
    {
        return Uuid::fromString($this->userId);
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return Uuid::fromString($this->emailId);
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

}
