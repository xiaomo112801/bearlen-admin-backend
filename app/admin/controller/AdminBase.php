<?php

namespace app\admin\controller;

use app\BaseController;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;
use think\App;
use think\Exception;
use think\Request;

/**
 * ADMIN模块基类
 */
class AdminBase extends BaseController
{

    protected $uid;

    public function __construct(App $app, Request $request)
    {
        parent::__construct($app);
        $this->uid = $request->uid;
    }


    /**
     * @throws JWTException
     */
    public function auth()
    {
        try {
            JWTAuth::auth();
        } catch (JWTException $JWTException) {
            throw new JWTException(['code' => '', 'message' => $JWTException->getMessage()]);
        }
    }

}