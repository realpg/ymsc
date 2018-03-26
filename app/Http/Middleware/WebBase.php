<?php

namespace App\Http\Middleware;

use App\Components\BannerManager;
use App\Components\BaseManager;
use App\Components\MenuManager;
use App\Components\ServiceManager;
use Closure;

class WebBase
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
