<?php
namespace app\api\handle;
use app\api\model\Msg;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
class ImgHandle implements EventHandlerInterface
{

    public function handle($payload = null)
    {
        // TODO: Implement handle() method.
        try {
            Msg::create([
                'openid'=>$payload['FromUserName'],
                'weixinid'=>$payload['ToUserName'],
                'createtime'=>$payload['CreateTime'],
                'type'=>$payload['MsgType'],
                'mediaid'=>$payload['MediaId'],
                'msgid'=>$payload['MsgId'],
                'pic_url'=>$payload['PicUrl']
            ]);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        return '已经接受,请等待回复';
    }
}