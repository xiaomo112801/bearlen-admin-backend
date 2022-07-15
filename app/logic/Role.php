<?php

namespace app\logic;

use app\model\Role as RoleModel;
use app\Request;

class Role extends BaseLogic
{

    private $role_model;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->role_model = new RoleModel;
    }

    public function getRoleList($page, $size, $map = [])
    {
        $role = new RoleModel();
        return $this->role_model->getPageList();
    }


    public function addRole($data): bool
    {
        return $this->role_model->save($data);
    }
}