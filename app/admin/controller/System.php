<?php

namespace app\admin\controller;

use app\logic\Role;

class System extends AdminBase
{

    public function getRoleList(Role $role)
    {

        $roleList = $role->getRoleList(1, 20, []);
        return json($roleList);

    }

}