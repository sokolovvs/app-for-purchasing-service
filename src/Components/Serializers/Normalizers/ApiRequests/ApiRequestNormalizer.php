<?php

namespace App\Components\Serializers\Normalizers\ApiRequests;


use App\Components\Serializers\Normalizers\DateTime\DateTimeNormalizer;
use App\Entity\ApiRequest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiRequestNormalizer implements NormalizerInterface
{
    private DateTimeNormalizer $dateTimeNormalizer;

    public function __construct(DateTimeNormalizer $dateTimeNormalizer)
    {
        $this->dateTimeNormalizer = $dateTimeNormalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var ApiRequest $object */

        return [
            'id' => $object->getId(),
            'subscription_id' => $object->getSubscription()->getId(),
            'called_at' => $this->dateTimeNormalizer->normalize($object->getCalledAt()),
            'content' => $object->getContent(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof ApiRequest;
    }
}
