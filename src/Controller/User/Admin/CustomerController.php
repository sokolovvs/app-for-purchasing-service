<?php

namespace App\Controller\User\Admin;


use App\Components\Interactors\CRUD\User\GetCustomersInteractor;
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
    ): JsonResponse {
        $paginator = $interactor->call($request->query->all());

        return $this->json(
            [
                'data' => $paginator->getQuery()->getResult(),
                'qty' => $paginator->count(),
            ]
        );
    }
}
