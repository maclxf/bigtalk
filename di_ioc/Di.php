<?php
namespace di_ioc;

use di_ioc\A;
/**
 *容器
 */
class Di {

    private $_register = [];

    public function create_a () {
        return new A();
    }

    public function set($key, $value) {
        $this->_register[$key] = $value;
    }

    public function get($key) {
        return isset($this->_register[$key]) ? $this->_register[$key]($this) : NULL;
    }

    public function get_share_a() {
        if (!isset($this->_register['a'])) {
            return $this->create_a();
        } else {
            return $this->_register['a']($this);
        }
    }


}


