<?php


namespace App\Components\Interactors\CRUD\TpsApiRequest;


use App\Repository\ApiRequestRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class GetRequestsByParams
{
    private ApiRequestRepository $apiRequestRepository;

    public function __construct(ApiRequestRepository $apiRequestRepository)
    {
        $this->apiRequestRepository = $apiRequestRepository;
    }

    /**
     * @param array $dto
     *
     * @return Paginator
     */
    public function call($dto)
    {
        return $this->apiRequestRepository->paginateApiRequests($dto);
    }
}
