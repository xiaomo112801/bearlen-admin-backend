<?php

namespace app\admin\controller;

use app\BaseController;
use thans\jwt\JWTAuth;
use app\model\User;

class Login extends BaseController
{

    /**
     * 用户登录
     */
    public function sign(User $user, JWTAuth $jwt)
    {
        $token = $jwt->builder(['uid' => $user->uid]);

        return ['token' => "Bearer " . $token];
    }

}