<?php
namespace SoftProxy;

interface ISoftGamer {
    public function login(string $user, string $password);
    public function killenemy();
    public function upgrade();
}


