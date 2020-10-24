<?php


namespace App\EventListener;


use App\Components\Errors\HttpError;
use App\Components\Exceptions\ApplicationExceptions\ImproveApplicationException;
use App\Components\Serializers\Normalizers\HttpError\HttpErrorNormalizerInterface;
use App\Components\Transformers\Exceptions\ExceptionToHttpErrorTransformerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionHandler implements EventSubscriberInterface
{
    private HttpErrorNormalizerInterface $httpErrorNormalizer;
    private LoggerInterface $logger;
    private ExceptionToHttpErrorTransformerInterface $exceptionToHttpErrorTransformer;

    public function __construct(
        HttpErrorNormalizerInterface $httpErrorNormalizer,
        ExceptionToHttpErrorTransformerInterface $exceptionToHttpErrorTransformer,
        LoggerInterface $logger
    ) {
        $this->httpErrorNormalizer = $httpErrorNormalizer;
        $this->logger = $logger;
        $this->exceptionToHttpErrorTransformer = $exceptionToHttpErrorTransformer;
    }

    public function handle(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $httpError = $this->exceptionToHttpErrorTransformer->transform($exception);
        $this->logger->warning('Exception was handled in global exception handler', ['exception' => $exception]);

        if (!$exception instanceof ImproveApplicationException || !$exception instanceof NotFoundHttpException) {
            $this->logger->critical('Unknown error', ['exception' => $exception]);
        }

        $this->sendResponse($event, $httpError);
    }

    private function sendResponse(ExceptionEvent $event, HttpError $httpError): void
    {
        //TODO: need check accept header and send response with needs format
        $event->setResponse(
            new JsonResponse(
                $this->httpErrorNormalizer->normalize($httpError), $httpError->getStatus(),
                ['Content-Type' => 'application/problem+json']
            )
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'handle',
        ];
    }
}
