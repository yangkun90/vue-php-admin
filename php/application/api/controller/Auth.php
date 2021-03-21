<?php
/** Created By china_wangyu@aliyun.com, Data: 2019/7/3 */

namespace app\api\controller;

use app\api\model\User;
use app\lib\exception\user\UserException;
use app\lib\token\Token;
use think\Request;

/**
 * Class Auth
 * @doc('授权类')
 * @group('auth')
 * @middleware('Validate')
 * @package app\api\controller
 */
class Auth
{
    /**
     * @doc('创建授权')
     * @route('','post')
     * @validate('Token')
     * @param('username','名称','require')
     * @param('password','密码','require')
     * @return \think\response\Json
     * @success('{
          "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUUlIiLCJpYXQiOjE1NjQwNDc4ODcsImV4cCI6MTU2NDA1NTA4NywidXVpZCI6MTAwLCJzaWduYXR1cmUiOiIxMiJ9.QAvjERUOvQ2QwUcPnQOJuYGuTDgzWCZ7gaNziJHDmVI",
          "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUUlIiLCJpYXQiOjE1NjQwNDc4ODcsInV1aWQiOjEwMCwic2lnbmF0dXJlIjoiMTIifQ.n-TZSFr9NqaTIjWpxR3ZUeP7WobYrhYvS5lIVkxRaIM"
          }')
     * @error('{
          "code": 3000,
          "message": "3000: 错误内容 . 参数验证 .   name不能为空,password不能为空",
          "request_url": "auth"
      }')
     */
    public function create(Request $request)
    {
        $username=$request->post('username');
        $password=$request->post('password');
        try {
            $data= (new User())->where('username','eq',$username)->where('password','eq',md5($password.config('salt')))->find();
        }catch (\Exception $e){
            throw new UserException();
        }
        if($data){
            return writeJson(200,Token::get($data->id,$username));
        }else{
            return writeJson(200,[],'密码或者账户错误',1000);
        }

    }

    /**
     * @doc('刷新授权')
     * @route('refresh','get')
     * @return array
     * @throws \app\lib\exception\token\TokenException
     * @throws \think\Exception
     * @success('{
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUUlIiLCJpYXQiOjE1NjQxMDY2ODAsImV4cCI6MTU2NDExMzg4MCwidXVpZCI6MTAwLCJzaWduYXR1cmUiOiIyMyJ9.1Te9jeAQVvj6VbgiVEk1-CChn8KybpOXqiyH8a4UB68"
        }')
     * @error('{
        "code": 3000,
        "message": "3000: 错误内容 . 1000: 错误内容 . 请求header未携带authorization信息",
        "request_url": "auth/refresh"
        }')
     */
    public function refresh()
    {
        $result = Token::refresh();
        return json($result, 200);
    }
}