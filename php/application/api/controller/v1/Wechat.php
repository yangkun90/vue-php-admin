<?php


namespace app\api\controller\v1;

use app\api\handle\ImgHandle;
use app\api\handle\LinkHandle;
use app\api\handle\LocationHandle;
use app\api\handle\MesHandle;
use app\api\handle\VideoHandle;
use app\api\handle\VoiceHandle;
use app\api\model\Msg;
use app\api\model\WechatConfig;
use EasyWeChat\Kernel\Messages\Message;
use Naixiaoxin\ThinkWechat\Facade;
use think\facade\Env;
/**
 * Class Wechat
 * @doc(微信入口类)
 * @group('v1/wechat')
 * @middleware('Validate')
 * @package app\api\controller\v1
 */
class Wechat
{
    /**
     * @doc('微信入口方法')
     * @route('','post')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function index(){
        $app = Facade::officialAccount('default');
        $app->server->push(MesHandle::class,Message::TEXT);
        $app->server->push(ImgHandle::class,Message::IMAGE);
        $app->server->push(VoiceHandle::class,Message::VOICE);
        $app->server->push(VideoHandle::class,Message::VIDEO);
        $app->server->push(LocationHandle::class,Message::LOCATION);
        $app->server->push(LinkHandle::class,Message::LINK);
        $app->server->serve()->send();
    }

}