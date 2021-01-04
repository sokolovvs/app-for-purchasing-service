<?php


namespace App\Components\Factories\Emails\Confirm;


use App\Components\Helpers\Env\EnvHelper;
use App\Components\Notifications\Mail\Mails\EmailConfirmMail;
use App\Components\Notifications\Mail\MailService\MailerService;
use App\Entity\User\User;
use Ramsey\Uuid\UuidInterface;
use Twig\Environment;

class EmailConfirmMailFactory
{
    private MailerService $mailerService;
    private Environment $engine;

    public function __construct(
        MailerService $mailerService,
        Environment $engine
    ) {
        $this->mailerService = $mailerService;
        $this->engine = $engine;
    }

    public function create(User $to, UuidInterface $confimationId): EmailConfirmMail
    {
        $body = $this->engine->render(
            'emails/confirmations/confirm_email.html.twig', [
                'host' => EnvHelper::getValue('API_URL'),
                'code' => $confimationId,
            ]
        );

        return new EmailConfirmMail(
            $this->mailerService, $to->getEmail(), $body
        );
    }
}
