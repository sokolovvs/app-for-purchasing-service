<?php


namespace App\Components\Transformers\Exceptions;


use App\Components\Errors\HttpError;
use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;
use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Exceptions\ApplicationExceptions\Resource\Validation\ValidationException;
use App\Components\Exceptions\ApplicationExceptions\Security\UnauthorizedException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ExceptionToHttpErrorErrorTransformer implements ExceptionToHttpErrorTransformerInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function transform($exception)
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        $instance = $currentRequest ? $currentRequest->server->get('REQUEST_URI') : null;
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $invalidParams = [];
        $additionalParams = [];

        if ($exception instanceof NotFoundHttpException) {
            $code = Response::HTTP_NOT_FOUND;
            $message = 'Unknown endpoint';
        }

        if ($exception instanceof ImproveApplicationException) {
            $invalidParams = $exception->getInvalidParams();
            $additionalParams = $exception->getAdditionalParams();
            $message = $exception->getMessage();

            if ($exception instanceof UnauthorizedException) {
                $code = Response::HTTP_UNAUTHORIZED;
            }

            if ($exception instanceof ResourceNotFoundException) {
                $code = Response::HTTP_NOT_FOUND;
            }

            if ($exception instanceof ValidationException) {
                $code = Response::HTTP_UNPROCESSABLE_ENTITY;
            }
        }

        $message = $message ?? 'Unknown error';

        return new HttpError(
            'https://tools.ietf.org/html/rfc2616#section-10', 'Error',
            $code, $message, $instance, $invalidParams, $additionalParams
        );
    }
}
