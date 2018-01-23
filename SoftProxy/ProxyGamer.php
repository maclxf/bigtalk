<?php
namespace SoftProxy;

use SoftProxy\ISoftGamer;
use SoftProxy\Gamer;

class ProxyGamer implements ISoftGamer {
    private $gamer;

    public function __construct(string $name) {
        $this->gamer = new Gamer($this, $name);
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
}