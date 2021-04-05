<?php

namespace App\Components\Serializers\Normalizers\Plan;


use App\Components\Serializers\Normalizers\Plan\Limits\PlanLimitNormalizer;
use App\Components\Transformers\Iterable\IterableTransformer;
use App\Entity\Plan;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PlanNormalizer implements NormalizerInterface
{
    private PlanLimitNormalizer $limitNormalizer;

    public function __construct(PlanLimitNormalizer $limitNormalizer)
    {
        $this->limitNormalizer = $limitNormalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var Plan $object */

        return [
            'id' => $object->getId(),
            'is_active' => $object->isActive(),
            'title' => $object->getTitle(),
            'amount' => $object->getAmount(),
            'description' => $object->getDescription(),
            'limits' => IterableTransformer::transform(
                $object->getPlanRequestsLimitInPeriods(),
                [$this->limitNormalizer, 'normalize']
            ),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Plan;
    }
}
