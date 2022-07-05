<?php

namespace app\admin\controller;

use app\model\Menu as MenuModel;

class Menu extends adminBase
{


    public function getMenuList(MenuModel $menu)
    {
        return json(['code'=>1,'data'=>$menu->getMenuList(),'message'=>'操作成功']);
    }


}