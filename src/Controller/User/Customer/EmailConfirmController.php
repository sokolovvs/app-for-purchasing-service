<?php


namespace App\Controller\User\Customer;


use App\Components\Dto\EmailConfirm\ConfrimEmailDto;
use App\Components\Interactors\CRUD\EmailConfirm\ConfirmEmail;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailConfirmController extends AbstractController
{
    private ConfirmEmail $confirmEmail;
    /**
     * @var JWTTokenManagerInterface
     */
    private JWTTokenManagerInterface $JWTTokenManager;

    public function __construct(ConfirmEmail $confirmEmail, JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->confirmEmail = $confirmEmail;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    #[Route('/api/v1/users/{userId}/emails/{emailId}/', name: 'email-confirm', requirements: [
        'userId' => "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}",
        'emailId' => "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}",
    ], methods: ['GET'])]
    public function confirmEmail(
        string $userId,
        string $emailId,
        Request $request
    ): JsonResponse {
        return $this->json(
            $this->JWTTokenManager->create(
                $this->confirmEmail->call(new ConfrimEmailDto($userId, $emailId, $request->query->get('hash', '')))
            )
        );
    }
}
