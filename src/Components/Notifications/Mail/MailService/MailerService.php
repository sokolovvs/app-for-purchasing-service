<?php


namespace App\Components\Notifications\Mail\MailService;


use App\Components\Exceptions\ApplicationExceptions\Notifications\SendNotificationException;
use App\Components\Helpers\Env\EnvHelper;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerService
{
    private Swift_SmtpTransport $transport;
    private Swift_Mailer $mailer;

    public function __construct()
    {
        $this->transport = (new Swift_SmtpTransport(
            EnvHelper::getValue('MAILER_HOST'), EnvHelper::getValue('MAILER_PORT')
        ))->setUsername(EnvHelper::getValue('MAILER_FROM_EMAIL'))
            ->setPassword(EnvHelper::getValue('MAILER_PASSWORD'))
            ->setEncryption('tls');

        $this->mailer = new Swift_Mailer($this->transport);
    }

    /**
     * @param Swift_Message $message
     *
     * @throws SendNotificationException
     */
    public function send(Swift_Message $message)
    {
        $failedMessages = [];
        $this->mailer->send($message, $failedMessages);

        if ($failedMessages) {
            throw SendNotificationException::fromInvalidParams($failedMessages);
        }
    }
}
