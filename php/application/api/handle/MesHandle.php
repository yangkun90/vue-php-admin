<?php
namespace app\api\handle;

use app\api\model\Msg;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class MesHandle implements EventHandlerInterface
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
                'content'=>$payload['Content'],
                'msgid'=>$payload['MsgId']
            ]);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        return '已经接受,请等待回复';
    }
}
