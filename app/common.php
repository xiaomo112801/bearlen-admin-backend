<?php

use think\Response;
use think\response\Json;

// 应用公共文件

/**
 * @param string $type success|error
 * @param array $data 返回数据
 * @param int $code
 * @param array $header
 * @param array $options
 * @return Response|Json
 */
function json(string $type, array $data = [], int $code = 200, array $header = [], array $options = [])
{
    $dataCode['code'] = $type == 'success' ? 1 : -1;
    return Response::create(array_merge($data, $dataCode), 'json', $code)->header($header)->options($options);
}