<?php
namespace app\api\handle;

use app\api\model\Msg;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class LocationHandle implements EventHandlerInterface
{

    public function handle($payload = null)
    {
        //这里$payload就是获取了消息信息

        try {
            Msg::create([
                'openid'=>$payload['FromUserName'],
                'weixinid'=>$payload['ToUserName'],
                'createtime'=>$payload['CreateTime'],
                'type'=>$payload['MsgType'],
                'msgid'=>$payload['MsgId'],
                'locationx'=>$payload['Location_X'],
                'locationy'=>$payload['Location_Y'],
                'scale'=>$payload['Scale'],
                'label'=>$payload['Label']
            ]);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        return '已经接受,请等待回复';
    }
}
