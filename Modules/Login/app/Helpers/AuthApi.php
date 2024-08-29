<?php

namespace Modules\Login\app\Helpers;

use Modules\Login\app\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthApi
{
    use SingletonTrait;

    private $user_id = 0;
    private $verify = false;

    public function verifyToken(string $token, bool $check_db = false)
    {
        try {
            $decoded = JWT::decode($token, new Key(config('login.api.secret'), 'RS256'));
            $data = $decoded['data'];
            $check_user = User::where('id',$data->user_id)->where('active',1)->count();
            if($check_user==0) throw new \Exception("Not found user!");
            $this->setData($decoded['data']);
            return true;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function setData($data)
    {
        $this->user_id = $data->user_id;
        $this->verify = true;
    }

    private function getUserId(){
        return $this->user_id;
    }

}
