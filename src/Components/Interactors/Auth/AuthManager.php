<?php


namespace App\Components\Interactors\Auth;


use App\Components\Exceptions\ApplicationExceptions\Resource\ResourceNotFoundException;
use App\Components\Exceptions\ApplicationExceptions\Security\AccessDeniedException;
use App\Components\Exceptions\ApplicationExceptions\Security\UnauthorizedException;
use App\Entity\RefreshToken;
use App\Entity\User\User;
use App\Repository\RefreshTokenRepository;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class AuthManager
{
    private UserRepository $userRepository;
    private LoggerInterface $logger;
    private TokenIssuer $issuer;
    private EntityManagerInterface $em;
    private RefreshTokenRepository $refreshTokenRepository;

    public function __construct(
        UserRepository $userRepository,
        TokenIssuer $issuer,
        LoggerInterface $logger,
        EntityManagerInterface $em,
        RefreshTokenRepository $refreshTokenRepository
    ) {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
        $this->issuer = $issuer;
        $this->em = $em;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    public function getCurrentUser(Request $request): ?User
    {
        try {
            return $this->extractUserFromDecodedToken($this->decodeToken($request->headers->get('Authorization')));
        } catch (Throwable $throwable) {
            $this->logger->info(sprintf("%s%s%s", $throwable->getMessage(), PHP_EOL, $throwable->getTraceAsString()));
        }

        return null;
    }

    public function getCurrentUserOrThrowException(Request $request): User
    {
        if ($user = $this->getCurrentUser($request)) {
            return $user;
        }

        throw new UnauthorizedException();
    }

    public function issueTokenForUser(User $user): string
    {
        $payload['user_id'] = $user->getId();

        return $this->issuer->fromPayload($payload);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return array<string, string>- Keys access_token, refresh_token
     * @throws UnauthorizedException
     */
    public function signIn(string $email, string $password): array
    {
        try {
            $user = $this->userRepository->findActiveByEmail($email);

            if ($user === null) {
                throw new ResourceNotFoundException();
            }

            if (!password_verify($password, $user->getPasswordHash())) {
                throw UnauthorizedException::invalidCredentials();
            }

            return [
                'access_token' => $this->issuer->fromUser($user),
                'refresh_token' => $this->generateRefreshToken($user),
            ];
        } catch (Throwable) {
            throw UnauthorizedException::invalidCredentials();
        }
    }

    /**
     * @param string $refreshToken
     *
     * @return string
     * @throws UnauthorizedException
     */
    public function updateAccessTokenWithRefreshToken(string $refreshToken): string
    {
        try {
            /* @var RefreshToken $refreshToken */
            $refreshToken = $this->refreshTokenRepository->findBy(['token' => $refreshToken]);

            if (!$refreshToken) {
                throw new ResourceNotFoundException();
            }

            return $this->issuer->fromUser($refreshToken->getUser());
        } catch (Throwable) {
            throw UnauthorizedException::invalidCredentials();
        }
    }

    /**
     * @param Request $request
     *
     * @throws AccessDeniedException
     * @throws UnauthorizedException
     */
    public function checkThatAuthorizedUserIsAdmin(Request $request): void
    {
        $user = $this->getCurrentUserOrThrowException($request);

        if (!$user->isAdmin()) {
            throw new AccessDeniedException();
        }
    }

    public function generateRefreshToken(User $user): string
    {
        $token = $this->issuer->fromUser($user);
        $refreshToken = new RefreshToken(Uuid::uuid4(), $user, $token);
        $user->addRefreshToken($refreshToken);
        $this->em->persist($refreshToken);

        return $token;
    }

    private function decodeToken(string $token): array
    {
        $token = explode(' ', $token)[1];

        return (array)JWT::decode($token, file_get_contents('../config/jwt/public.pem'), ['RS256']);
    }

    private function extractUserFromDecodedToken(array $tokenPayload): ?User
    {
        return $this->userRepository->findById($tokenPayload['user_id'] ?? null);
    }
}
