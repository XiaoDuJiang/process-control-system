<?php

class MyRedis
{
    private static $_instance = null;
    private $redis;

    private function __clone()
    {
    }

    private function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect(
            config('redis.host'),
            config('redis.port')
        );
        $this->redis->auth(config('redis.password'));
        # 连接哪个数据库 redis有0~15
        $this->redis->select(config('redis.select'));
    }

    /**
     * 单例实例化方法
     * @return MyRedis
     */
    public static function getInstance(): MyRedis
    {
        if (self::$_instance === null) {
            self::$_instance = new MyRedis();
        }
        return self::$_instance;
    }

    /**
     * 获取redis类方法
     * @return Redis
     */
    public function getRedis(): Redis
    {
        return $this->redis;
    }

    /**
     * 获取string类型的数据
     * @param string $key
     * @param string $create_func 获取函数(可选)
     * @param array $args 获取函数条件(可选)
     * @param int $ex 失效时间 小于等于0则永久有效
     * @return false|mixed|Redis|string
     * @throws RedisException
     */
    public function getStr(string $key, string $create_func = '', array $args = [], int $ex = 30)
    {
        $str = $this->redis->get($key);
        if (!$str && $create_func) {
            # 如果没有获取到说明需要从sql中进行获取数据则调用sql方法 sql方法必须返回对应的值
            $str = $create_func(...$args);
            # 如果还是没获取到则返回一个空值 并且设置返回值为空 解决缓存穿透问题
            if (!$str) {
                $str = '';
            }
            if ($ex > 0) {
                $this->redis->set($key, $str, [
                    'ex' => $ex
                ]);
            } else {
                $this->redis->set($key, $str);
            }
        }

        return $str ?: '';
    }

    /**
     * 获取hash数据
     * @param string $key
     * @param string $create_func 获取函数(可选)
     * @param array $args 获取函数条件(可选)
     * @param int $ex 失效时间 小于等于0则永久有效
     * @return array|false|mixed|Redis
     * @throws RedisException
     */
    public function getHash(string $key, string $create_func = '', array $args = [], int $ex = 30)
    {
        $hash = $this->redis->hGetAll($key);
        if (empty($hash) && $create_func) {
            # 如果没有获取到说明需要从sql中进行获取数据则调用sql方法 sql方法必须返回对应的值
            $hash = $create_func(...$args);
            # 如果还是没获取到则返回一个空值 并且设置返回值为空 解决缓存穿透问题
            if (empty($hash)) {
                $hash = [];
            }
            $this->redis->hMSet($key, $hash);
            if ($ex > 0) {
                $this->redis->expire($key, $ex);
            }
        }
        return $hash ?: [];
    }

    /**
     * 分布式锁创建函数
     * @param string $lock_name 锁的名称 可以通过名称实现一户一单的锁定等
     * @param string $callback 回调函数 保证没有锁之后通过的函数 需要返回一个true false用来判断是否执行成功
     * @param array $args 回调函数参数 (数组)
     * @param int $ex 锁过期时间 避免死锁问题 但是还是会有问题可能会出现还未执行完方法锁就过期的情况 还需要 watchdog
     * @return bool 业务逻辑被拒绝/执行成功
     * @throws RedisException
     * @throws RandomException
     * @throws Exception
     */
    public function distributedLock(string $lock_name, string $callback = '', array $args = [], int $ex = 30): bool
    {
        # 生成一个uuid保证锁的删除者是这个线程
        $uuid = uniqid(bin2hex(random_bytes(10)), true);
        # 产生锁 如果需要确保类似一个客户只能下一单的操作则需要通过锁名来控制
        $dis_lock_name = 'distributed:lock:' . $lock_name;
        $locked = $this->redis->set($dis_lock_name, $uuid, [
            'nx',
            'ex' => $ex
        ]);
        # 锁存在则说明已经在执行对应的操作了 直接返回
        if (!$locked) {
            return false;
        }
        # 锁没有则进行逻辑操作 处理一下异常 并且保证一定会删除这个锁
        try {
            # 回调函数执行后请返回true false 来显示是否执行成功
            return $callback(...$args);
        } catch (Exception $e) {
            throw new Exception('分布式锁回调函数执行失败');
        } finally {
            // 利用lua语言和redis的call函数来保证删除操作不阻塞现象
            $luaScript = <<<EOF
                    local counterKey = KEYS[1]
                    local uuid = ARGV[1]

                    local id = redis.call("get", counterKey);
                    if id == uuid then
                        return redis.call("del", counterKey)
                    end
                EOF;
            //第三个参数是通过key能访问的参数个数 其他都是ARGV
            $this->redis->eval($luaScript, [$dis_lock_name, $uuid], 1);
        }
    }

    public function setStrLogicExpire(string $key, string $value, int $ex)
    {
        # 过期时间
        $expire_time = time() + $ex;
        return $this->redis->hMSet($key, [
            'str' => $value,
            'expire' => $expire_time
        ]);
    }

    /**
     * 获取str类型的逻辑过期数据 逻辑过期数据是为了避免大key重构需要时间的问题的
     * @param string $key
     * @param string $create_func 创建的回调函数 必须返回true false来代表是否构建成功
     * @param array $args 回调函数参数
     * @return false|mixed|Redis|string
     * @throws RedisException
     */
    public function getStrLogicExpire(string $key, string $create_func = '', array $args = [])
    {
        # 先获取数据
        $hash = $this->redis->hGetAll($key);
        # 查询到了
        if ($hash && isset($hash['str']) && isset($hash['expire'])) {
            if ($hash['expire'] > time()) {
                # 未过期直接返回
                return $hash['str'];
            } else {
                # 过期了则需要去创建分布式锁
                $lock_name = 'logicExpireLock:' . $key;
                # 分布式锁去创建函数
                $res = $this->distributedLock($lock_name, $create_func, $args);
                if (!$res) {
                    # 分布式锁创建失败说明有线程在执行了则直接返回过期的数据
                    return $hash['str'];
                } else {
                    # 创建成功则获取后再返回
                    $str = $this->redis->hGet($key, 'str');
                    return $str;
                }
            }
        } else {
            # 未查询到或者字段不对
            throw new Exception('redis-key传递错误，未查询到对应的key');
        }
    }

}
