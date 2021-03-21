<?php


namespace app\api\controller\v1;

use app\lib\exception\user\UserException;
use app\lib\token\Token;
use think\Request;

/**
 * Class User
 * @doc(用户类)
 * @group('v1/user')
 * @middleware('Validate','Auth')
 * @package app\api\controller\v1
 */
class User
{
    /**
     * @doc('获取用户信息')
     * @route('getuserinfo','get')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function getUserInfo(Request $request){
        try {
            $data=Token::verification();
            $user=\app\api\model\User::with('roles')->find(['id'=>$data['uuid']]);
            $user=RoleArray($user);
        }catch (\Exception $e){
            throw new UserException();
        }

        return writeJson(200,$user);
    }

    /**
     * @doc('退出')
     * @route('logout','post')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function logout(){
        //刷新token
        Token::refresh();
        return writeJson(200,[]);
    }

    /**
     * @doc('获取所有用户')
     * @route('all','post')
     * @param('pageSize','每页个数')
     * @param('currentPage','当前页')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function all(Request $request){
        $pagesize=$request->post('pageSize')??config('pagesize');
        $currentpage=$request->post('currentPage')??config('currentpage');
        $offset=($currentpage-1) * $pagesize;
        try {
            $user=\app\api\model\User::limit($offset,$pagesize)->select();
            $count=\app\api\model\User::count();
        }catch (\Exception $e){
            throw new UserException();
        }
        return writeJson(200,['userlist'=>$user,'count'=>$count]);
    }

    /**
     * @doc('编辑用户')
     * @route('editone','post')
     * @param('id','用户id','require')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function editOne(Request $request){
        $data=$request->post();
        if(isset($data['status'])){
            $user=\app\api\model\User::get($data['id']);
            $user->status=$data['status'];
            $res=$user->save();
            if($res){
                return writeJson(200,[]);
            }
        }else{
            $user=\app\api\model\User::get($data['id']);
            $user->username=$data['username'];
            $user->name=$data['name'];
            $user->introduction=$data['introduction'];
            $user->save();
            return writeJson(200,[]);
        }
    }

    /**
     * @doc('删除用户 软删除')
     * @route('delete','get')
     * @param('id','用户id','require')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function delete(Request $request){
        $id=$request->get('id');
        if($id==1){
            return writeJson(200,[],'超级管理员不可删除',1000);
        }
        try {
            $res=\app\api\model\User::destroy($id);
        }catch (\Exception $e){
            throw new UserException();
        }
        return writeJson(200,$res);
    }
}