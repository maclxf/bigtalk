<?php
namespace HardP;

use HardP\IHardGamer;


class ProxyGamer implements IHardGamer {
    private $gamer;

    public function __construct(IHardGamer $gamer) {
        $this->gamer = $gamer;
    }


    public function login(string $user, string $password) {
        $this->gamer->login($user, $password);
    }
    public function killenemy() {
        $this->gamer->killenemy();
    }
    public function upgrade() {
        $this->gamer->upgrade();
    }

    public function get_proxy() {
        return $this;
    }
}