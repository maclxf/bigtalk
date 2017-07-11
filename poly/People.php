<?php
class People {
    private $_obj;
    public function __construct(Person $obj) {
        $this->_obj = $obj;
    }

    public function doing() {
        echo $this->_obj->work();
    }
}