<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        //判断前台是否有登录
        //需要在检测cookie
        /*
         * if(session('id') || $this->checkAuthCookie()){}
         * */

        $refer = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '';
        if(empty(session('id'))){
            //跳转到登录
            $url = url('/login').'?redirect='.$refer;
            return redirect($url)/*->with('error','您还没有登录')*/;
        }

        return $next($request);
    }
}
