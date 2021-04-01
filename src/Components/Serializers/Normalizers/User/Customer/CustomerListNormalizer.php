<?php

namespace App\Components\Serializers\Normalizers\User\Customer;


use App\Components\Serializers\Normalizers\DateTime\DateTimeNormalizer;
use App\Components\Serializers\Normalizers\Subscription\SubscriptionNormalizer;
use App\Components\Transformers\Iterable\IterableTransformer;
use App\Entity\User\Customer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomerListNormalizer implements NormalizerInterface
{
    private DateTimeNormalizer $dateTimeNormalizer;
    private SubscriptionNormalizer $subscriptionNormalizer;

    public function __construct(DateTimeNormalizer $dateTimeNormalizer, SubscriptionNormalizer $subscriptionNormalizer)
    {
        $this->dateTimeNormalizer = $dateTimeNormalizer;
        $this->subscriptionNormalizer = $subscriptionNormalizer;
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        /* @var Customer $object */

        return [
            'id' => $object->getId(),
            'email' => $object->getEmail(),
            'created_at' => $this->dateTimeNormalizer->normalize($object->getCreatedAt()),
            'is_active' => $object->isActive(),
            'subscriptions' => IterableTransformer::transform(
                $object->getSubscriptions(),
                [$this->subscriptionNormalizer, 'normalize']
            ),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Customer;
    }
}
