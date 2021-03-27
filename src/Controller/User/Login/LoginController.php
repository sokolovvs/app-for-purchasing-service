<?php


namespace App\Controller\User\Login;


use App\Components\Exceptions\ApplicationExceptions\Security\UnauthorizedException;
use App\Components\Interactors\Auth\AuthManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    #[Route('/api/v1/sign-in', name: 'sign-in', methods: ['POST'])]
    public function signIn(
        Request $request
    ): JsonResponse {
        try {
            return $this->json(
                $this->authManager->signIn($request->request->get('email'), $request->request->get('password'))
            );
        } catch (\Throwable) {
            throw UnauthorizedException::invalidCredentials();
        }
    }
}
