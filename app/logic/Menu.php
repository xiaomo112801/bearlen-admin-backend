<?php

namespace app\logic;

use app\model\RolePermissions;
use app\model\UserRole;
use app\Request;
use app\model\Menu as MenuModel;

class Menu extends BaseLogic
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }


    public function getMenuList($uid): array
    {
        $menu = new MenuModel;
        $user_role = new UserRole;
        $role_ids = $user_role->getUserRoleId($uid);
        $role_ids = array_column($role_ids->toArray(), 'role_id');
        $permissionsCondition = [['role', 'in', implode($role_ids)]];
        $role_permissions = new RolePermissions;
        $permissions = $role_permissions->getRolePermissions($permissionsCondition);
        $condition = [['id', 'in', $permissions]];
        $menuList = $menu->getMenuList($condition);
        return $this->getMenuTree($menuList, 0);
    }


    public function getMenuTree($menuList, $pid): array
    {
        $menuTree = [];
        foreach ($menuList as $k => $v) {
            if ($v['pid'] === $pid) {
                $menuTree[$k] = $v;
                $menuTree[$k]['childMenu'] = $this->getMenuTree($menuList, $v['id']);
            }
        }
        return $menuTree;
    }


}