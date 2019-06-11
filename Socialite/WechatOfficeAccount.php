<?php
require_once('Socialite.php');
require_once __DIR__ . '/../vendor/autoload.php';

use EasyWeChat\Factory;
use Socialite\Socialite;


class WechatOfficeAccount {
    private $app;
    public function __construct() {
        $config = Socialite::getWechatOfficeAccount();

        $this->app = Factory::officialAccount($config);
    }

	public function getUsers() {
        $users = $this->app->user->list();

        var_dump($users);

    }

    public function getUser() {
        $user = $this->app->user->get('onQMzwHDnSrffRJghFDovtfvuAOA');

        var_dump($user);
    }
}
