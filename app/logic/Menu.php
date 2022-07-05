<?php

namespace app\logic;

use app\Request;
use app\model\Menu as MenuModel;

class Menu extends BaseLogic
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }


    public function getMenuList()
    {
        $menu = new MenuModel;
        $menuList = $menu->getMenuList();
        $leveOneMenuList = array_filter($menuList, function ($item) {
            if ($item['pid'] == 0) {
                return $item;
            }
        });
        foreach ($leveOneMenuList as $k => $v) {
            $leveOneMenuList[$k]['childMenu'] = array_filter($menuList, function ($item) use ($v) {
                if ($v['id'] == $item['pid']) {
                    return $item;
                }
            });
        }
        return $leveOneMenuList;
    }


}