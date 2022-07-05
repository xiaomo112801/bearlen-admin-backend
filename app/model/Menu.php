<?php

namespace app\model;

use think\Model;

class Menu extends Model
{


    public function getMenuList(): array
    {
        return $this->select()->toArray();
    }
}