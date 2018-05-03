<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 10:19
 */

namespace App\Http\Middleware;

use Closure;

class CheckCookie
{
    public function handle($request, Closure $next)
    {
//        dd($request);
        //检测session中是否有登录信息
        if (!$request->cookie('user')) {

            return redirect('signIn');
        }
        return $next($request);
    }
}