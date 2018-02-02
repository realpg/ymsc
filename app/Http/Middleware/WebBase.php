<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 10:15
 */

namespace app\Http\Middleware;

use App\Components\BaseManager;
use App\Http\Controllers\ApiResponse;
use Closure;

class WebBase
{
    public function handle($request, Closure $next)
    {
        $request['base']=BaseManager::getBaseInfo();
        return $next($request);
    }
}