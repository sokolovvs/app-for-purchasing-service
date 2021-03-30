<?php

namespace App\Controller;


use App\Components\Dto\Requests\AddTpsApiRequestDto;
use App\Components\Interactors\CRUD\TpsApiRequest\AddRequestInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiRequestController extends AbstractController
{
    #[Route('/api/v1/tps_api_requests', name: 'create_tps_api_request', methods: ['POST'])]
    public function addTpsApiRequest(
        Request $request,
        AddRequestInteractor $interactor
    ) {
        $interactor->call(AddTpsApiRequestDto::fromHttpRequest($request));

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
