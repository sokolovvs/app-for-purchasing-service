<?php


namespace App\Components\Transformers;


interface TransformerInterface
{
    /**
     * @param mixed $exception
     *
     * @return mixed
     */
    public function transform($exception);
}
