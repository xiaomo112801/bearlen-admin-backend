<?php

namespace app\model;


class Menu extends BaseModel
{


    public function getMenuList(): array
    {
        return $this->select()->toArray();
    }
}