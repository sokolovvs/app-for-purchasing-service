<?php

namespace App\Entity;


use App\Repository\PlanRequestsLimitInPeriodRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=PlanRequestsLimitInPeriodRepository::class)
 */
class PlanRequestsLimitInPeriod
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="planRequestsLimitInPeriods")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plan;

    /**
     * @ORM\Column(type="integer")
     */
    private $period;

    /**
     * @ORM\Column(type="integer")
     */
    private $_limit;

    public function __construct(UuidInterface $id, Plan $plan, int $period, int $_limit)
    {
        $this->id = $id;
        $this->plan = $plan;
        $this->period = $period;
        $this->_limit = $_limit;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getPeriod(): int
    {
        return $this->period;
    }

    public function setPeriod(int $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->_limit;
    }

    public function setLimit(int $limit): self
    {
        $this->_limit = $limit;

        return $this;
    }
}
