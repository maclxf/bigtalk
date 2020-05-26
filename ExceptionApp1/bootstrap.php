<?php
session_start();
include "vendor/autoload.php";

class Bootstrap {
    public function init() {
        set_exception_handler([$this, 'exception']);
    }

    public function exception($e) {
        if (method_exists($e, 'render')) {
            $e->render();
        } else {
            die($e);
        }
    }
}

(new Bootstrap())->init();