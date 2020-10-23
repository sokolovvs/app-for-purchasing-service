<?php


namespace App\Components\Serializers\Normalizers\HttpError;


use App\Components\Errors\HttpError;

class HttpErrorNormalizer implements HttpErrorNormalizerInterface
{
    /**
     * @param HttpError   $object
     * @param string|null $format
     * @param array       $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'type' => $object->getType(),
            'title' => 'Error',
            'status' => $object->getStatus(),
            'detail' => $object->getDetail(),
            'instance' => $object->getInstance(),
            'invalid_params' => $object->getInvalidParams(),
            'additional_params' => $object->getAdditionalParams(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof HttpError;
    }
}
