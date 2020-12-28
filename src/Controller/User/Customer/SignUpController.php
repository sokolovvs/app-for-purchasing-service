<?php


namespace App\Controller\User\Customer;


use App\Components\Dto\User\ClientSignUpDto;
use App\Components\Interactors\CRUD\User\CustomerSignUpInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SignUpController extends AbstractController
{
    private CustomerSignUpInteractor $clientSignUpInteractor;

    public function __construct(CustomerSignUpInteractor $clientSignUpInteractor)
    {
        $this->clientSignUpInteractor = $clientSignUpInteractor;
    }

    #[Route('/api/v1/register', name: 'client-sign-up', methods: ['POST'])]
    public function signUp(
        Request $request
    ): JsonResponse {
        $this->clientSignUpInteractor->call(ClientSignUpDto::fromHttpRequest($request));

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
