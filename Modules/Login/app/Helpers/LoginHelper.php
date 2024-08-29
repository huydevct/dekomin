<?php

namespace Modules\Login\app\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginHelper
{
    static function AuthApi()
    {
        return AuthApi::getInstance();
    }

    static function createJwtAuthUser($user_id, int $exp = 86400)
    {
        $payload = [
            'data' => [
                'user_id' => $user_id
            ],
            'exp' => time() + $exp
        ];
        return JWT::encode($payload, config('login.api.secret'), 'HS256');
    }

}
