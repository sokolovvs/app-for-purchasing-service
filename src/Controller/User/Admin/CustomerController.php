<?php

namespace App\Controller\User\Admin;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Helpers\Constants\RouteRequirements;
use App\Components\Interactors\Auth\AuthManager;
use App\Components\Interactors\CRUD\User\GetCustomersInteractor;
use App\Repository\User\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/api/v1/customers', name: 'get-customers', methods: ['GET'])]
    public function getCustomersByParams(
        Request $request,
        GetCustomersInteractor $interactor,
        AuthManager $authManager
    ): JsonResponse {
        $authManager->getCurrentUserOrThrowException($request);
        $paginator = $interactor->call($request->query->all());

        return $this->json(
            [
                'data' => $paginator->getQuery()->getResult(),
                'qty' => $paginator->count(),
            ]
        );
    }

    #[Route('/api/v1/customers/{userId}', name: 'get-customers', requirements: [
        'userId' => RouteRequirements::UUID_FORMAT,
    ], methods: ['GET'],)]
    public function getCustomerById(
        string $userId,
        CustomerRepository $customerRepository
    ): JsonResponse {

        $user = $customerRepository->find($userId);

        if (!$user) {
            throw new ResourceNotFoundException();
        }

        return $this->json($user);
    }
}
