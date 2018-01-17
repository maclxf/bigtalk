<?php
namespace HardP;

interface IHardGamer {
    public function login(string $user, string $password);
    public function killenemy();
    public function upgrade();
    public function get_proxy();
}


