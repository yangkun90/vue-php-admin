<?php


namespace app\api\controller\v1;

use app\api\model\Msg;
use think\Request;
/**
 * Class Wechatmes
 * @doc(微信消息)
 * @group('v1/wechatmes')
 * @middleware('Validate','Auth')
 * @package app\api\controller\v1
 */
class Wechatmes
{
    /**
     * @doc('用户消息获取')
     * @route('mesall','post')
     * @param('pageSize','每页个数')
     * @param('currentPage','当前页')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function mesall(Request $request){
        $pagesize=$request->post('pageSize')??config('pagesize');
        $currentpage=$request->post('currentPage')??config('currentpage');
        $offset=($currentpage-1) * $pagesize;
        try {
            $mes=Msg::limit($offset,$pagesize)->select();
            $count=Msg::count();
        }catch (\Exception $e){
            return writeJson(400,$e->getMessage());
        }
        return writeJson(200,['mes'=>$mes,'count'=>$count]);
    }
    /**
     * @doc('用户消息修改')
     * @route('editone','get')
     * @param('msg_id','消息id','require')
     * @param('status','状态','require')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function editOne(Request $request){
        $msg_id=$request->get('msg_id');
        $status=$request->get('status');
        try{
            $msg=Msg::get($msg_id);
                $msg->status=$status;
            $msg->save();
        }catch(\Exception $e){
            return writeJson(400,$e->getMessage());
        }
        return writeJson(200,$msg);
    }
    
}