<?php


namespace App\Controller\User\Admin;


use App\Components\Dto\Plan\AddPlanDto;
use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Helpers\Constants\RouteRequirements;
use App\Components\Interactors\Auth\AuthManager;
use App\Components\Interactors\CRUD\Plan\AddPlanInteractor;
use App\Repository\PlanRepository;
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
        AddPlanInteractor $interactor,
        AuthManager $authManager
    ) {
        $request->request->set("id", Uuid::uuid4()->toString());
        $authManager->checkThatAuthorizedUserIsAdmin($request);

        return $this->json($interactor->call(AddPlanDto::fromRequest($request)), Response::HTTP_CREATED);
    }

    #[Route('/api/v1/plans', name: 'get-plans', methods: ['GET'])]
    public function getPlans(
        PlanRepository $planRepository
    ) {
        return $this->json($planRepository->findAll());
    }

    #[Route('/api/v1/plans/{planId}', name: 'get-plan', requirements: [
        'planId' => RouteRequirements::UUID_FORMAT,
    ], methods: ['GET'])]
    public function getPlan(
        string $planId,
        PlanRepository $planRepository
    ) {
        $plan = $planRepository->find($planId);

        if (!$plan) {
            throw new ResourceNotFoundException("Plan not found");
        }

        return $this->json($plan);
    }
}
