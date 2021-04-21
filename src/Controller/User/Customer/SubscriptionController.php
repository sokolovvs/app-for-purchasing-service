<?php


namespace App\Controller\User\Customer;


use App\Components\Interactors\Auth\AuthManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class SubscriptionController extends AbstractController
{
    #[Route('/api/v1/subscriptions', name: 'subscribe', methods: ['POST'])]
    public function subscribe(
        Request $request,
        AuthManager $authManager
    ): JsonResponse {
        $user = $authManager->getCurrentUserOrThrowException($request);


        if (false) {
            // TODO: check that user hasn't an active subscription
            return $this->json(null, Response::HTTP_CONFLICT);
        }

        try {
            //TODO card auth
        } catch (Throwable $e) {
            // TODO handle errors & handle need 3D secure
        }

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
