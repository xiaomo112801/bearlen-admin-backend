<?php

use think\facade\Route;


Route::group(function () {
    Route::get('user:uid', 'User/index');
    Route::get('getMenuList', 'Menu/getMenuList');
    Route::get('getRoleList', 'System/getRoleList');

    Route::post('addRole', 'System/addRole');
    Route::post('modifyPassword','User/modifyPassword');
})->middleware(thans\jwt\middleware\JWTAuthAndRefresh::class);

Route::post('sign', 'login/sign')->middleware(\think\middleware\Throttle::class, [
    'visit_rate' => '5/m'
]);
Route::get('verify', 'login/getVerifyCode')->middleware(\think\middleware\Throttle::class, [
    'visit_rate' => '10/m'
]);
Route::post('loginOut', 'login/loginOut');