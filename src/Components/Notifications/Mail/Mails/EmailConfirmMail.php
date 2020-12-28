<?php


namespace App\Components\Notifications\Mail\Mails;


use App\Components\Helpers\Env\EnvHelper;
use App\Components\Notifications\Mail\MailService\MailerService;
use App\Components\Notifications\NotificationInterface;
use App\Entity\EmailConfirm;
use App\Entity\User\User;
use Swift_Message;

final class EmailConfirmMail implements NotificationInterface
{
    private MailerService $mailerService;
    private string $subject;
    private string $body;
    private array|string $to;

    public function __construct(
        MailerService $mailerService,
        string|array $to,
        User $user,
        EmailConfirm $emailConfirm
    ) {
        $this->mailerService = $mailerService;
        $this->subject = 'Confirm your email';
        $host = EnvHelper::getValue('API_URL');
        $this->body =
            "Please, go to this <a href=\"$host/users/{$user->getId()}/emails/{$emailConfirm->getId()}/?hash={$emailConfirm->getHash()}\">link</a> to end sign up";
        $this->to = $to;
    }

    public function send()
    {
        $message = (new Swift_Message($this->subject))
            ->setFrom(
                [
                    EnvHelper::getValue('MAILER_FROM_EMAIL') => EnvHelper::getValue('MAILER_FROM_NAME'),
                ]
            )
            ->setTo($this->to)
            ->setBody($this->body);

        $this->mailerService->send($message);
    }
}
