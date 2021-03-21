<?php


namespace app\api\controller\v1;
use app\api\model\WechatConfig;
use app\lib\exception\wechat\WechatException;
use think\Request;
/**
 * Class Wechatcmss
 * @doc(微信cms类)
 * @group('v1/wechatcms')
 * @middleware('Validate')
 * @package app\api\controller\v1
 */
class Wechatcms
{
    /**
     * @doc('微信基础配置')
     * @route('edit','post')
     * @param('appsecret','appsecret','require')
     * @param('token','token','require')
     * @param('id','id','require')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function edit(Request $request){
        $appid=$request->post('appid');
        $appsecret=$request->post('appsecret');
        $token=$request->post('token');
        $id=$request->post('id');
        try {
            $weconfig=WechatConfig::get($id);
            $weconfig->appid=$appid;
            $weconfig->appsecret=$appsecret;
            $weconfig->token=$token;
            $weconfig->save();
        }catch (\Exception $e){
            throw new WechatException();
        }
        return writeJson(200,[],'修改成功');
    }

    /**
     * @doc('获取配置信息')
     * @route('get','get')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function get(){
        try {
            $data=WechatConfig::find();
        }catch (\Exception $e){
            throw new WechatException();
        }
        return  writeJson(200,$data);
    }
}