<?php

namespace app\admin\controller;

use app\logic\Role;

class System extends AdminBase
{


    public function getRoleList(Role $role): \think\response\Json
    {

        $roleList = $role->getRoleList(1, 20, []);
        return json($roleList);

    }


    public function addRole(Role $role): \think\response\Json
    {
        $role_name = input('post.role');
        $res = $role->addRole(['role'=>$role_name]);
        if ($res) {
            return json(['code' => 1, 'message' => '操作成功']);
        } else {
            return json(['code' => -1, 'message' => '操作失败']);
        }
    }

}