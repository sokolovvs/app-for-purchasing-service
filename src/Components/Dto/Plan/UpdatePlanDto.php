<?php


namespace App\Components\Dto\Plan;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdatePlanDto
{
    #[Assert\NotNull]
    #[Assert\Uuid]
    private $id;

    #[Assert\NotNull]
    #[Assert\Type("bool")]
    private $isActive;

    #[Assert\Type("numeric")]
    #[Assert\NotNull]
    #[Assert\GreaterThanOrEqual(0)]
    private $amount;

    #[Assert\Type("numeric")]
    #[Assert\NotNull]
    #[Assert\GreaterThanOrEqual(0)]
    private $period;

    #[Assert\Type("string")]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private $title;


    #[Assert\Type("string")]
    private $description;

    /**
     * @Assert\All(
     * @Assert\Collection(
     *     fields = {
     *         "id" = @Assert\Uuid,
     *         "period" = @Assert\Required({
     *             @Assert\NotBlank,
     *             @Assert\Type("numeric")
     *         }),
     *         "limit" = @Assert\Required({
     *             @Assert\NotBlank,
     *             @Assert\Type("numeric")
     *         })
     *     },
     *     allowMissingFields = true
     * )
     * )
     */
    private $limits;

    public function __construct($id, $isActive, $amount, $period, $title, $description, $limits = [])
    {
        $this->id = $id;
        $this->isActive = $isActive;
        $this->amount = $amount;
        $this->title = $title;
        $this->description = $description;
        $this->period = $period;
        $this->limits = $limits;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->request->get("id"), (bool)$request->request->get('is_active', true),
            $request->request->get('amount'), (int)$request->request->get('period'), $request->request->get('title'),
            $request->request->get('description'), $request->request->get('limits')
        );
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return (int)($this->amount * 100);
    }

    /**
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getLimits()
    {
        return $this->limits;
    }
}
