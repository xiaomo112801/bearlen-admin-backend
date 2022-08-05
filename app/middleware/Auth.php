<?php

namespace app\middleware;

//鉴权中间件
use think\exception\HttpException;

class Auth
{

    public function handle($request, \Closure $next)
    {

        return $next($request);
    }

}