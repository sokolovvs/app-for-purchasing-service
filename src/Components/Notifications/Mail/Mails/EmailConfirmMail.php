<?php


namespace App\Components\Notifications\Mail\Mails;


use App\Components\Helpers\Env\EnvHelper;
use App\Components\Notifications\Mail\MailService\MailerService;
use App\Components\Notifications\NotificationInterface;
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
        string $body
    ) {
        $this->mailerService = $mailerService;
        $this->subject = 'Confirm your email';
        $this->body = $body;
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
