<?php

namespace App\Servers;

use App\Exceptions\ValidateException;

class Validate {
    public static function make() {
        if (!$_POST['title']) {
            throw new ValidateException('请填写标题信息！');
        }
    } 
}