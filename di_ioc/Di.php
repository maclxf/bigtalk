<?php
namespace di_ioc;
/**
 *容器
 */
class Di {

    private $_register = [];

    public function create_a () {
        return new a();
    }

    public function set($key, $value) {
        $this->_register[$key] = $value;
    }

    public function get() {
        return isset($this->_register[$key]) ? $this->_register[$key] : NULL;
    }

    public function get_share_a() {
        if (!isset($this->_register['a'])) {
            return $this->create_a();
        } else {
            return $this->_register['a'];
        }
    }


}


