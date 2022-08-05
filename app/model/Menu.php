<?php

namespace app\model;


class Menu extends BaseModel
{


    public function getMenuList($condition): array
    {


        return $this
            ->where($condition)
            ->field('id,title,pid,icon,module,url,type,menu_type,sort,level,index,permissions')
            ->order('id asc')
            ->select()
            ->toArray();
    }
}