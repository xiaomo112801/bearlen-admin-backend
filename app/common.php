<?php
// 应用公共文件

//密码加密
function encryption($pwd): string
{
    $key = config('app.encrypt_key');
    return openssl_encrypt($pwd, 'DES-ECB', $key);
}


//解密方法
function decryption($secret): string
{
    $key = config('app.encrypt_key');
    return openssl_decrypt($secret, 'DES-ECB', $key);
}
