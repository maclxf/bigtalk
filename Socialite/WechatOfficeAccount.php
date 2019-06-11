<?php
namespace Socialite;



use EasyWeChat\Factory;
use Socialite\Socialite;


class WechatOfficeAccount {
    private $app;
    public function __construct() {
        $config = Socialite::getWechatOfficeAccount();

        $this->app = Factory::officialAccount($config);
    }

    /********************************************************/
    /**
     * https://www.easywechat.com/docs/4.1/official-account/user
     * @author lxf 2019-06-11
     * @return [type] [description]
     */
	public function getUsers() {
        $users = $this->app->user->list();

        var_dump($users);

    }

    public function getUser() {
        $user = $this->app->user->get('onQMzwHDnSrffRJghFDovtfvuAOA');

        var_dump($user);
    }

    public function getBlackList() {
        $blacklist = $this->app->user->blacklist(); // $beginOpenid 可选

        var_dump($blacklist);
    }

    /*************************************************************************/
    //构造微信jsdk的微信配置
    //https://www.easywechat.com/docs/4.1/basic-services/jssdk
    public function getJSSDKConfig() {
        $ret  = $this->app->jssdk->buildConfig(array("chooseImage", "uploadImage"), true, false, false);

        var_dump($ret);
    }


    /*********************************************************/

    public function getShortUrl($url) {
        $shortUrl = $this->app->url->shorten($url);
        var_dump($shortUrl);
    }

    /*********************************************************/

    /**
     * 获取当前菜单
     * https://www.easywechat.com/docs/4.1/official-account/menu
     * @author lxf 2019-06-11
     * @return [type] [description]
     */
    public function getMenuList() {
        //$list = $this->app->menu->list();

        $current = $this->app->menu->current();

        echo '<pre>';
        var_dump($current);
    }


    public function getCustomerList() {
        $customers = $this->app->customer_service->list();

        echo '<pre>';
        var_dump($customers);
    }

    public function getDataCube() {
        $userSummary = $this->app->data_cube->userSummary('2019-12-07', '2019-01-08');

        echo '<pre>';
        var_dump($userSummary);

    }



}


