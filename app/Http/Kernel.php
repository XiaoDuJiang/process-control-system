<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        # 配置新人哪些代理服务器设置HTTP头
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        # 检查应用工程需是否处于维护模式
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        # 检查POST数据大小是否超过限制
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        # 对自带的字符串进行修剪操作
        \App\Http\Middleware\TrimStrings::class,
        # 将空字符串转换为null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        # 允许跨域
        \Fruitcake\Cors\HandleCors::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            # 对cookie进行加密
            \App\Http\Middleware\EncryptCookies::class,
            # 将队列的cookie添加到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            # 启动session
            \Illuminate\Session\Middleware\StartSession::class,
            # 对session进行认证
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            # 将session中的错误共享到视图
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            # 验证CSRF令牌
//            \App\Http\Middleware\VerifyCsrfToken::class,
            # 替换路由绑定
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            # JWTtoken验证
            \App\Http\Middleware\VerifyJwtToken::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    /**
     * 中间件的优先级排序列表
     *
     * 将会强制非全局中间件始终保持给定的顺序
     *
     * @var array
     */
    protected $middlewarePriority = [

    ];
}
