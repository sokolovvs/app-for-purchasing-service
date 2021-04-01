<?php

namespace App\Components\Transformers\Iterable;


class IterableTransformer
{
    public static function transform(iterable $items, callable $transformer): array
    {
        $transformedItems = [];

        foreach ($items as $item) {
            $transformedItems[] = $transformer($item);
        }

        return $transformedItems;
    }
}
