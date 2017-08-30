<?php
//namespace di_ioc;


/**
 * 容器
 */
class Container {

    /**
     * 存储具体的外部资源
     * @var array
     */
    private $co = [];

    public function __set($key, $value) {
        // new in
        $this->co[$key] = $value;
    }

    public function __get($key) {
        return isset($this->co[$key]) ? $this->co[$key]($this) : NULL;
    }
}


