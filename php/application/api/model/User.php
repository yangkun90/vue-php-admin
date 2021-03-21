<?php


namespace app\api\model;


use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;
    protected $pk='id';
    protected $autoWriteTimestamp = true;
    protected $deleteTime = 'delete_time';
    protected $hidden=['password','create_time','update_time','delete_time'];


    public function roles(){
        return $this->belongsToMany('Roles','user_roles','role_id','user_id');
    }
}