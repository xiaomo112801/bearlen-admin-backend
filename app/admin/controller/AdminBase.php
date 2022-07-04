<?php

namespace app\admin\controller;

use app\BaseController;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;
use think\App;
use think\Exception;

/**
 * ADMIN模块基类
 */
class AdminBase extends BaseController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
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