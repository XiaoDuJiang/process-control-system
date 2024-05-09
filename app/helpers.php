<?php

/**
 * 创建返回值数组
 * @param array $data 数据
 * @param string $message 消息
 * @param bool $success 是否成功
 * @return array ['code','message','data']
 */
function create_response_data(string $message, bool $success = true , array $data = []): array
{
    $code = $success ? 200 : 500;
    return [
        'code' => $code,
        'message' => $message,
        'data' => $data,
    ];
}

/**
 * 密码加密
 * @param string $password 密码
 * @return string 加密后的密码
 */
function password_md5(string $password): string
{
    $password = 'pcs' . $password;
    return md5($password);
}
