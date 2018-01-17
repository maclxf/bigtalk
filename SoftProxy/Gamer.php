<?php
namespace SoftProxy;

use SoftProxy\ISoftGamer;

class Gamer implements ISoftGamer {
    private $name;

    /**
     * [__construct description]
     * @author lxf 2018-01-18
     * @param  ISoftGamer $gamer 代理对象
     * @param  string     $name  [description]
     */
    public function __construct(ISoftGamer $gamer, string $name) {
        if (!$gamer) {
            exit('不能创建角色！');
        } else {
            $this->name = $name;
        }
    }


    public function login(string $user, string $password) {
        echo '登陆名为 ' . $user . '的用户' . $this->name  . '用密码' . $password . '登陆成功！';
        echo '登录时间' . date('Y-m-d H:i:s', time());
    }
    public function killenemy() {
        echo $this->name . '正在刷怪！';
    }
    public function upgrade() {
        echo $this->name . '升级成功';
        echo '升级时间' . date('Y-m-d H:i:s', time());
    }
}