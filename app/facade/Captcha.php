<?php

namespace app\facade;


use think\Facade;

/**
 * @package think\captcha\facade
 * @mixin \app\Captcha
 */
class Captcha extends Facade
{
    protected static function getFacadeClass()
    {
        return "app\Captcha";
    }
}