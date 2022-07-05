<?php

namespace app\admin\controller;

use app\logic\Menu as MenuLogic;

class Menu extends adminBase
{


    public function getMenuList(MenuLogic $menu): \think\response\Json
    {
        return json(['code'=>1,'data'=>$menu->getMenuList(),'message'=>'操作成功']);
    }


}