<?php

namespace App\Components\Serializers\Normalizers\HttpError;


use App\Components\Errors\HttpError;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

interface HttpErrorNormalizerInterface extends NormalizerInterface
{
    /**
     * @param HttpError   $object
     * @param string|null $format
     * @param array       $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = []);

    public function supportsNormalization($data, string $format = null);
}
