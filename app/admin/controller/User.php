<?php

namespace app\admin\controller;

use app\Request;
use think\App;
use think\db\exception\DbException;
use think\exception\ValidateException;
use app\model\User as UserModel;

class User extends AdminBase
{


    public function __construct(App $app, \think\Request $request)
    {
        parent::__construct($app, $request);
    }

    public function index()
    {

    }


    public function getUserPermissions()
    {

    }


    public function modifyPassword(UserModel $user)
    {
        try {
            $old_password = input('post.oldPassword', '');
            $new_password = input('post.newPassword', '');
            $re_new_password = input('post.reNewPassword', '');

            $rule = [
                'old_password|原密码' => 'require',
                'new_password|新密码' => 'require|length:8,16|different:old_password',
                're_new_password|确认密码' => 'require|confirm:new_password'
            ];
            $data = [
                'old_password' => $old_password,
                'new_password' => $new_password,
                're_new_password' => $re_new_password
            ];
            $this->validate($data, $rule);

            $user_info = $user->find($this->uid);

            $user_info->save(['password' => encryption($new_password)]);

            return json(['code' => 1, 'message' => '操作成功']);
        } catch (ValidateException $validateException) {
            return json(['code' => -1, 'message' => $validateException->getError()]);
        } catch (DbException $dbException) {
            return json(['code' => $dbException->getCode(), 'message' => $dbException->getMessage()]);
        }

    }


    public function getUserInfo(UserModel $user)
    {
        $data = [
            'code' => 1,
            'data' => $user->find($this->uid)->toArray(),
            'message' => '操作成功'
        ];
        return json($data);
    }


}