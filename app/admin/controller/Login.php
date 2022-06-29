<?php

namespace app\admin\controller;

use app\BaseController;
use app\model\User;
use thans\jwt\JWTAuth;
use captcha\Captcha;
use think\db\exception\DbException;
use think\exception\HttpException;
use think\exception\ValidateException;
use hg\apidoc\annotation as Apidoc;


/**
 * @Apidoc\Title（"登录"）
 * @Apidoc\Group("Login")
 *
 */
class Login extends BaseController
{

    /**
     * @Apidoc\Title("用户登录接口")
     * @Apidoc\Method("POST")
     */
    public function sign(JWTAuth $jwt, User $user)
    {
        try {
            $user_name = input("post.username");
            $password = input("post.password");
            $verity_code = input("post.verity_code");
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
            return json(['code' => -1, 'message' => $validateException->getError()]);
        } catch (DbException $dbException) {
            return json($dbException->getMessage(), $dbException->getCode());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @Apidoc\Title("获取验证码")
     * @Apidoc\Method("get")
     *
     */
    public function getVerifyCode(Captcha $captcha)
    {
        $image = $captcha->create();
        return (['code' => 0, 'message' => '操作成功', "data" => base64_encode($image)]);
    }

}