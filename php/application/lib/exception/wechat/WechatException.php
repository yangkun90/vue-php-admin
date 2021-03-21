<?php


namespace app\lib\exception\wechat;


use WangYu\exception\Exception;

class WechatException extends Exception
{
    protected $message = '微信错误';
    protected $code = 400;
    protected $user_code = 500;
}