<?php

namespace App\Components\Serializers\Normalizers\Plan;


use App\Entity\Plan;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PlanNormalizer implements NormalizerInterface
{

    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var Plan $object */
        return [
            'id' => $object->getId(),
            'is_active' => $object->isActive(),
            'title' => $object->getTitle(),
            'amount' => $object->getAmount(),
            'description' => $object->getDescription(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Plan;
    }
}
