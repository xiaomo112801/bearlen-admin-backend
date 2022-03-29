<?php

use think\facade\Route;


Route::group(function () {

    Route::get('user:uid', 'user/index');
})->middleware(\app\middleware\JWT::class);

Route::post('/sign', 'login/sign')->model("username&password", "app\model\User", false);

Route::get('/verify', "login/verify");