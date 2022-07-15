<?php

namespace app\admin\controller;

use think\exception\ValidateException;

class User extends AdminBase
{

    public function index()
    {

    }


    public function modifyPassword()
    {
        try{
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


        }catch (ValidateException $validateException){
            return json(['message' => $validateException->getError()]);
        }

    }


}