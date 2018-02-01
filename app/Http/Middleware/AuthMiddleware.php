<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
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
        //判断后台是否有登录
        if(empty(session('admin'))){
            //跳转到登录
            return redirect('/admin/login')/*->with('error','您还没有登录')*/;
        }

        return $next($request);
    }
}
