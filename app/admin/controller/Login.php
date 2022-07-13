<?php

namespace app\admin\controller;

use app\BaseController;
use app\model\User;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;
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
     * @Apidoc\Url("/admin/sign")
     * @Apidoc\Method("POST")
     * @Apidoc\Param("username", type="stirng",require=true, desc="用户名")
     * @Apidoc\Param("password", type="stirng",require=true, desc="密码")
     * @Apidoc\Param("verficationCode", type="stirng",require=true, desc="验证码")
     * @Apidoc\Returned("data", type="string", desc="token",replaceGlobal=true)
     */
    public function sign(User $user, Captcha $captcha)
    {
        try {
            $username = input("post.username");
            $password = input("post.password");
            $verity_code = input("post.verficationCode");
            $rule = [
                "username" => "require",
                "password" => "require|length:8,16",
                "verity_code" => "require"
            ];
            $data = [
                'username' => $username,
                'password' => $password,
                'verity_code' => $verity_code
            ];
            $this->validate($data, $rule); //验证数据，不通过通过数据校验类抛出异常
            if (!$captcha->check($verity_code)) {
                return json(['code' => -1, 'message' => '验证码校验错误']);
            }
            $userInfo = $user->where(['username' => $username, 'password' => encryption($password)])->find();
            if (!$userInfo['uid']) {
                return json(['code' => -1, 'message' => '用户名或密码错误']);
            }
            $payload = [
                'uid' => $userInfo['uid'],
            ];
            $token = JWTAuth::builder($payload);//创建token

            return json(['code' => 1, 'message' => '登录成功', 'data' => "Bearer " . $token], 200, ['authorization' => "Bearer " . $token]);
        } catch (HttpException $httpException) {
            return json(['message' => $httpException->getMessage()], 500);
        } catch (ValidateException $validateException) {
            return json(['message' => $validateException->getError()]);
        } catch (DbException $dbException) {
            return json(['message' => $dbException->getMessage()], $dbException->getCode());
        } catch (\Exception $e) {
            return json(['code' => $e->getCode(), 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }


    /**
     * @Apidoc\Title("获取验证码")
     * @Apidoc\Url("/admin/verify")
     * @Apidoc\Method("POST")
     * @Apidoc\Param("username", type="stirng",require=true, desc="用户名")
     * @Apidoc\Param("password", type="stirng",require=true, desc="密码")
     * @Apidoc\Param("verficationCode", type="stirng",require=true, desc="验证码")
     * @Apidoc\Returned("data", type="string", desc="token",replaceGlobal=true)
     */
    public function getVerifyCode(Captcha $captcha)
    {
        $image = $captcha->create();
        return (['code' => 0, 'message' => '操作成功', "data" => base64_encode($image)]);
    }


    /**
     * @Apidoc\Title("用户退出接口")
     * @Apidoc\Url("/admin/loginOut")
     * @Apidoc\Method("POST")
     * @Apidoc\Returned("data", type="boolen", desc="是否退出成功",replaceGlobal=true)
     */
    public function loginOut()
    {
        try {
            JWTAuth::auth();
            $tokenStr = JWTAuth::token()->get();
            JWTAuth::invalidate($tokenStr);
            return json(['code' => 1, 'message' => '退出成功']);
        } catch (JWTException $JWTException) {
            return ['code' => $JWTException->getCode(), 'message' => $JWTException->getMessage()];
        }

    }

}