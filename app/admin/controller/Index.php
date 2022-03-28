<?php
declare (strict_types = 1);

namespace app\admin\controller;
use hg\apidoc\annotation as Apidoc;


/**
 * @Apidoc\Title("基础示例")
 * @Apidoc\Group("base")
 */
class Index
{

    /**
     * @Apidoc\Title("基础的注释方法")
     * @Apidoc\Desc("最基础的接口注释写法")
     * @Apidoc\Method("GET")
     * @Apidoc\Tag("测试")
     * @Apidoc\Param("username", type="abc",require=true, desc="用户名")
     * @Apidoc\Param("password", type="string",require=true, desc="密码")
     * @Apidoc\Param("phone", type="string",require=true, desc="手机号")
     * @Apidoc\Param("sex", type="int",default="1",desc="性别" )
     * @Apidoc\Returned("data", type="array", desc="返回数据1",replaceGlobal=true,
     *     @Apidoc\Returned("id", type="int", desc="id"),
     * )
     */
    public function index()
    {
        return '您好！这是一个[admin]示例应用';
    }
}
