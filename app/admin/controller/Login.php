<?php

namespace app\admin\controller;

use app\BaseController;
use thans\jwt\JWTAuth;
use think\exception\HttpException;
use think\exception\ValidateException;
use hg\apidoc\annotation as Apidoc;


/**
 * @Apidoc\Title（"用户登录控制器"）
 * @Apidoc\Group("login")
 */
class Login extends BaseController
{

    /**
     * @Apidoc\Title("用户登录接口")
     */
    public function sign(JWTAuth $jwt)
    {
        try {

            $user_name = input("post.username");
            $password = input("post.password");
            $rule = [
                "user_name" => "require",
                "password" => "require|length:8,16"
            ];
            $data = [
                'user_name' => $user_name,
                'password' => $password
            ];

            $this->validate($data, $rule);

            return ['token' => "Bearer "];
        } catch (HttpException $httpException) {
            return json($httpException->getMessage(), 500);
        } catch (ValidateException $validateException) {
            return json($validateException->getError());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}