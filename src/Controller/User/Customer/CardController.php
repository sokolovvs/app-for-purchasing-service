<?php


namespace App\Controller\User\Customer;


use App\Components\Dto\User\ClientSignUpDto;
use App\Components\Helpers\Constants\RouteRequirements;
use App\Components\Interactors\Auth\AuthManager;
use App\Components\Interactors\CRUD\Card\AddCardInteractor;
use App\Components\Interactors\CRUD\Card\RemoveCardInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    private AddCardInteractor $addCardInteractor;
    private RemoveCardInteractor $removeCardInteractor;
    private AuthManager $authManager;

    public function __construct(AddCardInteractor $addCardInteractor, RemoveCardInteractor $removeCardInteractor, AuthManager $authManager)
    {
        $this->addCardInteractor = $addCardInteractor;
        $this->removeCardInteractor = $removeCardInteractor;
        $this->authManager = $authManager;
    }

    #[Route('/api/v1/card', name: 'add-card', methods: ['POST'])]
    public function addCard(
        Request $request,
    ): JsonResponse {
//        $this->addCardInteractor->call();

        return $this->json(null, Response::HTTP_ACCEPTED);
    }

    #[Route('/api/v1/card/{cardId}', name: 'delete-card', requirements: [
        'cardId' => RouteRequirements::UUID_FORMAT,
    ], methods: ['DELETE'])]
    public function deleteCard(Request $request)
    {
        $user = $this->authManager->getCurrentUserOrThrowException($request);

        $this->removeCardInteractor->call();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
