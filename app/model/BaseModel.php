<?php

namespace app\model;

use think\Model;

class BaseModel extends Model
{


    public function getPageList()
    {
        return $this->select();
    }

}