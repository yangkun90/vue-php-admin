<?php


namespace app\lib\exception\user;


use WangYu\exception\Exception;

class UserException extends Exception
{
    protected $message = '用户数据错误';
    protected $code = 400;
    protected $user_code = 500;
}