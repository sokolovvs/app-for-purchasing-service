<?php


namespace App\Components\Serializers\Normalizers\HttpError;


use App\Components\Errors\HttpError;

/**
 * This class defines a "problem detail" as a way to carry machine-readable details of errors in a HTTP response
 * to avoid the need to define new error response formats for HTTP APIs.
 *
 * @package App\Components\Errors\Http
 * @link    https://tools.ietf.org/html/rfc7807 RFC7807
 */
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
        $normalizedData = [
            'type' => $object->getType(),
            'title' => 'Error',
            'status' => $object->getStatus(),
            'detail' => $object->getDetail(),
            'instance' => $object->getInstance(),
            'invalid_params' => $object->getInvalidParams(),
            'additional_params' => $object->getAdditionalParams(),
        ];

        if ($object->getDebugData()) {
            $normalizedData['debug'] = $object->getDebugData();
        }

        return $normalizedData;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof HttpError;
    }
}
