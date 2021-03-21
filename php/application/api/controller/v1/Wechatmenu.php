<?php


namespace app\api\controller\v1;

use think\Request;
use Naixiaoxin\ThinkWechat\Facade;
/**
 * Class Wechatmenu
 * @doc(微信菜单类)
 * @group('v1/wechatmenu')
 * @middleware('Validate','Auth')
 * @package app\api\controller\v1
 */
class Wechatmenu
{
    /**
     * @doc('微信菜单配置')
     * @route('menuset','post')
     * @param('menu','菜单信息','require')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function menuset(Request $request){
        $menu=$request->post('menu');
        $menu=$menu['button'];
        $app = Facade::officialAccount(); 
        return writeJson(200,$app->menu->create($menu));
    }

    /**
     * @doc('微信菜单获取配置')
     * @route('menuget','post')
     * @return \think\response\Json
     * @success('')
     * @error('')
     */
    public function menuget(Request $request){
        $app = Facade::officialAccount(); 
        return writeJson(200,$app->menu->list()); 
    }
}