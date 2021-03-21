<?php


namespace app\api\model;


use think\Model;
use think\model\concern\SoftDelete;

class Roles extends Model
{
    use SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $deleteTime = 'delete_time';
    protected $hidden=['password','create_time','update_time','delete_time'];
}