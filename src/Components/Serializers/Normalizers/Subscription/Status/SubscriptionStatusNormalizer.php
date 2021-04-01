<?php

namespace App\Components\Serializers\Normalizers\Subscription\Status;


use App\Entity\SubscriptionStatus;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SubscriptionStatusNormalizer implements NormalizerInterface
{

    /**
     * @inheritDoc
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var SubscriptionStatus $object */

        return [
            'id' => $object->getId(),
            'title' => $object->getTitle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof SubscriptionStatus;
    }
}
