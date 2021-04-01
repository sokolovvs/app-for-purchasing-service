<?php

namespace App\Components\Serializers\Normalizers\Subscription;


use App\Components\Serializers\Normalizers\DateTime\DateTimeNormalizer;
use App\Components\Serializers\Normalizers\Plan\PlanNormalizer;
use App\Components\Serializers\Normalizers\Subscription\Status\SubscriptionStatusNormalizer;
use App\Entity\Subscription;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SubscriptionNormalizer implements NormalizerInterface
{
    private DateTimeNormalizer $dateTimeNormalizer;
    private PlanNormalizer $planNormalizer;
    private SubscriptionStatusNormalizer $subscriptionStatusNormalizer;

    public function __construct(
        DateTimeNormalizer $dateTimeNormalizer,
        PlanNormalizer $planNormalizer,
        SubscriptionStatusNormalizer $subscriptionStatusNormalizer
    ) {
        $this->dateTimeNormalizer = $dateTimeNormalizer;
        $this->planNormalizer = $planNormalizer;
        $this->subscriptionStatusNormalizer = $subscriptionStatusNormalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var Subscription $object */

        return [
            'id' => $object->getId(),
            'plan' => $this->planNormalizer->normalize($object->getPlan()),
            'status' => $this->subscriptionStatusNormalizer->normalize($object->getStatus()),
            'created_at' => $this->dateTimeNormalizer->normalize($object->getCreatedAt()),
            'expired_at' => $this->dateTimeNormalizer->normalize($object->getExpiredAt()),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Subscription;
    }
}
