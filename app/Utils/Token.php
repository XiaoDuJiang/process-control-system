<?php

namespace App\Utils;

use Firebase\JWT\JWT as JWTUtil;
use Firebase\JWT\Key as JWTKey;
use Firebase\JWT\ExpiredException;

class Token
{
    function createToken(array $user = [], int $exp_time = 24 * 60 * 60): string
    {
        $key = config('token.jwt_secret_key'); //jwt的签发密匙 人为设置的密钥
        $time = time(); //签发时间
        $expire = $time + $exp_time; //过期时间
        $token = array(
            "uid" => $user['id'],
            "iss" => "pcs_sys", //签发组织
            "aud" => 'jxd',
            "iat" => $time,
            "nbf" => $time,
            "exp" => $expire
        );
        return JWTUtil::encode($token, $key, config('token.alg'), 'keyId');
    }

    function verifyToken($token)
    {
        $key = config('token.jwt_secret_key'); //jwt的签发密匙 人为设置的密钥
        try {
            # 客户信息 json编码
            $jwt_key = new JWTKey($key, config('token.alg'));

            //$jwtAuth = json_encode(JWTUtil::decode($token, $jwt_key));
            # 客户信息 json解码 转化为PHP变量
            //$authInfo = json_decode($jwtAuth, true);
            $authInfo = JWTUtil::decode($token, $jwt_key);
            return create_response_data('验证成功', true, [
                'uid' => $authInfo->uid,
            ]);
        } catch (ExpiredException $e) {
            return create_response_data('token过期', false);
        } catch (\Exception $e) {
            return create_response_data('token错误', false);
        }
    }

}
