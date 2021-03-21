<?php


namespace app\api\model;


use think\Model;

class WechatConfig extends Model
{
    protected $autoWriteTimestamp = true;
    protected $hidden = ['create_time', 'update_time'];
}