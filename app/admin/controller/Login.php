<?php

namespace app\admin\controller;

use app\BaseController;
use app\model\User;
use thans\jwt\JWTAuth;
use app\facade\Captcha;
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
     * @Apidoc\Url("/admin/sign")
     */
    public function sign(User $user, JWTAuth $jwt)
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
//            $user
            $this->validate($data, $rule);

            return ['token' => "Bearer "];
        } catch (HttpException $httpException) {
            return json('error', ['message' => $httpException->getMessage()], 500);
        } catch (ValidateException $validateException) {
            return json('error', ['message' => $validateException->getError()], 500);
        } catch (\Exception $e) {
            return json('error', ['message', $e->getMessage()], 500);
        }
    }

    public function verify()
    {
        $verify = Captcha::create();
        return json('success', ['verify' => $verify]);
    }

}