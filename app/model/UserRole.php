<?php

namespace app\model;

class UserRole extends BaseModel
{
    public function getUserRoleId($uid)
    {
        return $this->where(['uid'=>$uid])->select();
    }
}