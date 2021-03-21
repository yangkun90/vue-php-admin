<?php


namespace app\api\validate;


use WangYu\validate\Validate;

class Token extends Validate
{
    protected $rule = [
        'username' => ['require'],
        'password' => ['require'],
    ];
}