<?php

namespace App\Components\Serializers\Normalizers\Plan\Limits;


use App\Entity\PlanRequestsLimitInPeriod;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PlanLimitNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var PlanRequestsLimitInPeriod $object */

        return [
            'id' => $object->getId(),
            'limit' => $object->getLimit(),
            'period' => $object->getPeriod(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof PlanRequestsLimitInPeriod;
    }
}
