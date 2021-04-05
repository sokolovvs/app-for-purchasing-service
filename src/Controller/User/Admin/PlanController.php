<?php


namespace App\Controller\User\Admin;


use App\Components\Dto\Plan\AddPlanDto;
use App\Components\Interactors\CRUD\Plan\AddPlanInteractor;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanController extends AbstractController
{
    #[Route('/api/v1/plans', name: 'create-plan', methods: ['POST'])]
    public function createPlan(
        Request $request,
        AddPlanInteractor $interactor
    ) {
        $request->request->set("id", Uuid::uuid4()->toString());

        return $this->json($interactor->call(AddPlanDto::fromRequest($request)), Response::HTTP_CREATED);
    }
}
