<?php

namespace app\logic;

use app\model\Role as RoleModel;
use app\Request;

class Role extends BaseLogic
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function getRoleList($page,$size,$map=[])
    {
        $role = new RoleModel();
        return $role->getPageList();

    }
}