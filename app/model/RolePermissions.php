<?php

namespace app\model;

class RolePermissions extends BaseModel
{
    public function getRolePermissions($condition): string
    {
        $permissions_arr = $this->where($condition)->select()->toArray();

        $permissions_arr = array_column($permissions_arr, 'permissions');

        return implode($permissions_arr);
    }
}