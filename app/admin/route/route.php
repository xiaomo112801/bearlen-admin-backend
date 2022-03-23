<?php

use think\facade\Route;


Route::group(function () {
    Route::get('user:uid', 'user/index');
})->middleware(\app\middleware\JWT::class);