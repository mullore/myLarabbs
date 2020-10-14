<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * 三个判断：
         * 1.用户已经登录
         * 2.并且还未认证
         * 3.并且访问的不是 email 验证相关 URL 或者 退出的 URL
         * */
        if($request->user()
        && !$request->user()->hasVerifiedEmail()
        && !$request->is('email/*','logout'))
        {
            return  $request->expectsJson() ? abort('403','邮箱地址还没认证！') :
                redirect()-route('verification.notice');
        }
        return $next($request);
    }
}
