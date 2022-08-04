<?php

namespace app\admin\controller;

use app\Request;
use think\exception\ValidateException;
use app\model\User as UserModel;

class User extends AdminBase
{

    public function index()
    {

    }


    public function getUserPermissions()
    {

    }


    public function modifyPassword()
    {
        try {
            $old_password = input('post.oldPassword', '');
            $new_password = input('post.newPassword', '');
            $re_new_password = input('post.reNewPassword', '');

            $rule = [
                'oldPassword' => 'require',
                'new_password' => 'require|length:8,16',
                're_new_password' => 'require|confirm:password'
            ];
            $data = [
                'oldPassword' => $old_password,
                'new_password' => $new_password,
                're_new_password' => $re_new_password
            ];
            $this->validate($data, $rule);


        } catch (ValidateException $validateException) {
            return json(['message' => $validateException->getError()]);
        }

    }


    public function getUserInfo(UserModel $user, Request $request)
    {
        $data = [
            'code' => 1,
            'data' => $user->find($request->uid)->toArray(),
            'message' => '操作成功'
        ];
        return json($data);
    }


}