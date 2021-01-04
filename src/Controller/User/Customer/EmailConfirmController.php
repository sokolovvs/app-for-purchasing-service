<?php


namespace App\Controller\User\Customer;


use App\Components\Interactors\Auth\AuthManager;
use App\Components\Interactors\CRUD\EmailConfirm\ConfirmEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmailConfirmController extends AbstractController
{
    private ConfirmEmail $confirmEmail;
    private AuthManager $authManager;

    public function __construct(ConfirmEmail $confirmEmail, AuthManager $authManager)
    {
        $this->confirmEmail = $confirmEmail;
        $this->authManager = $authManager;
    }

    #[Route('/api/v1/email/confirm/', name: 'email-confirm', methods: ['GET'])]
    public function confirmEmail(
        Request $request
    ) {
        $this->confirmEmail->call($request->query->get('code', ''));

        return $this->render('app/email_was_confirmed.html.twig');
    }
}
