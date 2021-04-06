<?php


namespace App\Components\Interactors\CRUD\Plan;


use App\Components\Dto\Plan\UpdatePlanDto;
use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Validation\ApplicationValidatorInterface;
use App\Entity\PlanRequestsLimitInPeriod;
use App\Repository\PlanRepository;
use App\Repository\PlanRequestsLimitInPeriodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class UpdatePlanInteractor
{
    private EntityManagerInterface $em;
    private PlanRepository $planRepository;
    private ApplicationValidatorInterface $validator;
    private PlanRequestsLimitInPeriodRepository $limitRepository;

    public function __construct(
        EntityManagerInterface $em,
        PlanRepository $planRepository,
        PlanRequestsLimitInPeriodRepository $limitRepository,
        ApplicationValidatorInterface $validator
    ) {
        $this->em = $em;
        $this->planRepository = $planRepository;
        $this->validator = $validator;
        $this->limitRepository = $limitRepository;
    }

    /**
     * @param UpdatePlanDto $dto
     *
     * @return void
     */
    public function call($dto)
    {
        $this->validator->validate($dto);
        $plan = $this->planRepository->find($dto->getId());

        if (!$plan) {
            throw new ResourceNotFoundException();
        }

        $this->em->transactional(
            function () use ($plan, $dto) {
                $plan->setDescription($dto->getDescription())
                    ->setTitle($dto->getTitle())
                    ->setPeriod($dto->getPeriod());

                if ($dto->isActive()) {
                    $plan->enable();
                }

                $plan->disable();

                $this->em->persist($plan);

                foreach ($plan->getPlanRequestsLimitInPeriods() as $limit) {
                    $this->em->remove($limit);
                }

                $newIds = [];

                foreach ($dto->getLimits() as $limit) {
                    $id = $limit['id'] ?? null;
                    $limitEntity = null;

                    if ($id) {
                        $limitEntity = $this->limitRepository->find($id);
                    }

                    if (!$limitEntity) {
                        $limitEntity = new PlanRequestsLimitInPeriod(
                            Uuid::uuid4(), $plan, $limit['period'], $limit['limit']
                        );
                    }

                    $this->em->persist($limitEntity);
                }

                $this->em->persist($plan);
                $this->em->flush();
            }
        );
    }
}
