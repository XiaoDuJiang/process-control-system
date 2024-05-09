<?php

class MyRedis
{
    private static $redis = Null;

    private function __clone(){}

    private function __construct(){}

    public static function getRedis()
    {
        if(!self::$redis) {
            self::$redis = new Redis();
            self::$redis->connect(
                config('redis.host'),
                config('redis.port')
            );
            self::$redis->auth(config('redis.password'));
            # 连接哪个数据库 redis有0~15
            self::$redis->select(config('redis.select'));
        }
        return self::$redis;
    }
}
