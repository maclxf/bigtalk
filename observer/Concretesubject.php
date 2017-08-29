<?php
namespace observer;

use observer\subject;
// 具体通知者类
class Concretesubject extends Subject {

    public $subjectstatus;
    public function __construct(string $name) {
        $this->name = $name;
    }

}






