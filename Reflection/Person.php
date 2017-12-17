<?php

class Person {

    public $name = '默认名字';

    private $age = 18;

    /**
     * 说
     * @author lxf 2017-12-15
     * @return [type] [description]
     */
    public function say() {
        echo $this->name;
    }

    /**
     * 设置
     * @author lxf 2017-12-15
     * @param  [type] $name  [description]
     * @param  [type] $value [description]
     */
    private function _set($name, $value) {
        $this->name = $value;
    }

    /**
     * 获取
     * @author lxf 2017-12-15
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    private function _get($name) {
        if (!isset($this->name)) {
            echo '没得名字';
            $this->name = 'CR7';
        }

        return $this->name;
    }

    /**
     * 说年纪
     * @author lxf 2017-12-15
     * @return [type] [description]
     */
    public function say_age() {
        echo $this->age;
    }
}