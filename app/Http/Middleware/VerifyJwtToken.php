<?php

namespace App\Http\Middleware;

use App\Utils\Token;
use Closure;
use Illuminate\Http\Request;

class VerifyJwtToken
{

    private $whit_list = [
        '/',
        'login/loginIn',
        'login/register',
    ];

    public function handle(Request $request, Closure $next)
    {
        //验证jwtToken 并且通过白名单
        if (!in_array($request->path(), $this->whit_list)) {
            # 不是白名单则需要验证token
            $token_str = $request->header('Authorization');
            $token_str = $token_str ?: '';
            $jwtToken = new Token();
            $res = $jwtToken->verifyToken($token_str);
            # 验证失败不给值
            if ($res['code'] === 500) {
                return response()->json(['code' => 500, 'message' => '未授权']);
            } else {
                # 验证成功将用户id传给所有的请求中(方便调用)
                $request->merge(
                    ['token_uid' => $res['data']['uid']]
                );
            }
        }

        return $next($request);
    }
}
