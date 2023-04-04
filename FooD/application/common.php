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



function newphone($str){

    $num = substr($str,3,4);

    return  $newphone = str_replace($num,'****',$str);
}

function pr($data)
{
    dump($data);
    die;
}

/**json返回格式
 * @param int $code
 * @param string $msg
 * @param array $data
 */
function returnAjax($code = 200, $msg = 'ok', $data = [])
{
    header('Content-Type:application/json; charset=utf-8');
    //允许跨域
    header('Access-Control-Allow-Origin:*');
    $json = [
        'code'      =>      $code,
        'msg'       =>      $msg,
        'data'      =>      $data,
    ];
    //防止中文乱码
    exit(json_encode($json,JSON_UNESCAPED_UNICODE));
}

/**日期格式化
 * @param string $format
 * @return false|string
 */
function getTime($format='Y-m-d H:i:s')
{
    return date($format);
}

/**判断密码只能是数字字母下划线6-16
 * @param $str
 * @return bool
 */
function isPassword($str) {
    if (preg_match('/^[_0-9a-z]{6,16}$/i',$str)){
        return true;
    }else {
        return false;
    }
}