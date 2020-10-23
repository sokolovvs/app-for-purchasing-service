<?php


namespace App\Components\Transformers\Exceptions;


use App\Components\Errors\HttpError;
use App\Components\Transformers\TransformerInterface;
use Throwable;

/**
 * Interface ExceptionToHttpTransformerInterface
 *
 * @package App\Components\Transformers\Exeptions
 */
interface ExceptionToHttpErrorTransformerInterface extends TransformerInterface
{
    /**
     * @param Throwable $exception
     *
     * @return HttpError
     */
    public function transform($exception);
}
