<?php

namespace Modules\Login\app\Http\Middleware;

use Modules\Login\app\Helpers\LoginHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseSymfony;

class AuthApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) : ResponseSymfony
    {
        $token =  $request->header('AuthorizationApi');
        if(empty($token)) $token =  $request->input('access_token');
        if(empty($token)){
            return Response::json([
                'error' => "Not found token!"
            ],401);
        }
        $verify_token = LoginHelper::AuthApi()->verifyToken($token,true);
        if($verify_token!=true){
            return Response::json([
                'error' => $verify_token['error']
            ],401);
        }
        return $next($request);
    }
}
