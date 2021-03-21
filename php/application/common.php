<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 统一响应包装函数
 * @param $code
 * @param $errorCode
 * @param $data
 * @param $msg
 * @return Json
 */
function writeJson($code, $data, $msg = 'ok', $errorCode = 0)
{
    $data = [
        'code' => $errorCode,
        'data' => $data,
        'message' => $msg
    ];
    return json($data, $code);
}

/**
 * 格式化权限角色
 * @param $data
 */
function RoleArray(&$data){
    $arr=[];
    foreach ($data['roles'] as $key=>$item){
        $arr[]=$item['name'];
    }
    unset($data['roles']);
    $data['roles']=$arr;
    return $data;
}

