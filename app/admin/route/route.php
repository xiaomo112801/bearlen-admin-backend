<?php

use think\facade\Route;


Route::group(function () {

    Route::get('user:uid', 'user/index');
})->middleware(\app\middleware\JWT::class);

Route::post('sign', 'login/sign');
Route::get('verify', 'login/getVerifyCode');