<?php

namespace App\Components\Serializers\Normalizers\DateTime;


use DateTimeInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DateTimeNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var DateTimeInterface $object */
        return $object->format('c');
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof DateTimeInterface;
    }
}
