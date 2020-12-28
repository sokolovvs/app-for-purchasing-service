<?php


namespace App\EventListener;


use DateTime;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;

class JwtCreatedListener
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            return;
        }

        try {
            $request = json_decode($request->getContent());
            if ($request->remember) {
                $expiration = new DateTime('+168 hour');

                $payload = $event->getData();
                $payload['exp'] = $expiration->getTimestamp();
                $event->setData($payload);
            }
        } catch (Exception $e) {
            return;
        }
    }

    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        if (!$event->getException() instanceof BadCredentialsException) {
            throw $event->getException();
        }

        $data = 'Ошибка авторизации, проверьте правильность ввода логина/пароля';

        $response = new JWTAuthenticationFailureResponse($data);
        $response->setStatusCode(422);

        $event->setResponse($response);
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['user'] = [
            'phone' => $user->getUsername(),
            'id' => $user->getId(),
        ];

        $event->setData($data);
    }

    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status' => '401',
            'message' => 'Неавторизован',
        ];

        $response = new JsonResponse($data, 401);

        $event->setResponse($response);
    }

    /**
     * @param JWTExpiredEvent $event
     */
    public function onJWTExpired(JWTExpiredEvent $event)
    {
        $data = [
            'status' => '401',
            'message' => 'Время токена закончилось',
        ];

        $response = new JsonResponse($data, 401);
        $event->stopPropagation();
        //        $event->setResponse($response);
    }
}
