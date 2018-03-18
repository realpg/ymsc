<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 10:15
 */

namespace app\Http\Middleware;

use App\Components\BaseManager;
use App\Components\MenuManager;
use App\Components\ServiceManager;
use App\Http\Controllers\ApiResponse;
use Closure;

class WebBase
{
    public function handle($request, Closure $next)
    {
        $base=BaseManager::getBaseInfo();
        $services=ServiceManager::getAllServices();
        $cartes=MenuManager::getMenuListswhichCanShow();
        $common['base']=$base;
        $common['services']=$services;
        $common['cartes']=$cartes;
        $request['common']=$common;
        return $next($request);
    }
}