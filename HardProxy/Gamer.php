<?php
namespace HardP;

use HardP\IHardGamer;
use HardP\ProxyGamer;

class Gamer implements IHardGamer {
    private $name;
    private $proxy;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function get_proxy() {
        $this->proxy = new ProxyGamer($this);

        return $this->proxy;
    }


    public function login(string $user, string $password) {
        if ($this->is_proxy()) {
            echo '登陆名为 ' . $user . '的用户' . $this->name  . '用密码' . $password . '登陆成功！';
            echo '登录时间' . date('Y-m-d H:i:s', time());
        } else {
            echo '请用代理!';
        }

    }
    public function killenemy() {
        if ($this->is_proxy()) {
            echo $this->name . '正在刷怪！';
        } else {
            echo '请用代理!';
        }

    }
    public function upgrade() {
        if ($this->is_proxy()) {
            echo $this->name . '升级成功';
            echo '升级时间' . date('Y-m-d H:i:s', time());
        } else {
            echo '请用代理!';
        }
    }

    private function is_proxy() {
        return $this->proxy == NULL;
    }
}