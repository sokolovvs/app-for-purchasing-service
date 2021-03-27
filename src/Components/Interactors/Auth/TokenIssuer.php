<?php


namespace App\Components\Interactors\Auth;


use App\Components\Helpers\Env\EnvHelper;
use App\Entity\User\User;
use Firebase\JWT\JWT;

class TokenIssuer implements TokenIssuerInterface
{
    public function fromPayload(array $payload): string
    {
        $privateKey = file_get_contents('../config/jwt/private.pem');
        $decryptedKey = openssl_pkey_get_private($privateKey, EnvHelper::getValue('JWT_PASS'));
        $payload['iss'] = EnvHelper::getValue('DOMAIN_URL');
        $payload['iat'] = time();

        return sprintf("Bearer %s", JWT::encode($payload, $decryptedKey, 'HS256'));
    }

    public function fromUser(User $user): string
    {
        $payload['user_id'] = $user->getId();

        return $this->fromPayload($payload);
    }
}
