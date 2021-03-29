<?php

namespace App\Entity;


use App\Repository\PlanRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=PlanRepository::class)
 */
class Plan
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**getIsActive
     * @ORM\Column(type="integer")
     */
    private $period;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $description;

    public function __construct(
        UuidInterface $id,
        bool $isActive,
        int $amount,
        int $period,
        string $title,
        ?string $description = null
    ) {
        $this->id = $id;
        $this->is_active = $isActive;
        $this->amount = $amount;
        $this->period = $period;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function disable(): self
    {
        $this->is_active = false;

        return $this;
    }

    public function enable(): self
    {
        $this->is_active = true;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
