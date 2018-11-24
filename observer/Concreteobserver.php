<?php
namespace observer;
use observer\iobserver;
// 观察者类
class Concreteobserver implements Iobserver {

    /**
     * 观察者的名称
     * @var [type]
     */
    public $name;

    /**
     * 要观察的状态
     * @var [type]
     */
    private $observerstatus;

    /**
     * 通知人
     * @var [type]
     */
    public $subject;

    public function __construct(string $name, $subject) {
        $this->name = $name;
        $this->subject = $subject;
    }

    /**
     * 当通知者的状态发生变化，观察者应当做出相应的操作
     * @author lxf 2017-08-24
     * @return [type] [description]
     */
    public function update() {
        // 根据通知人的告知观察者做相应的动作
        $this->observerstatus = $this->subject->subjectstatus;

        if ($this->observerstatus == 1) {
            echo $this->name . '停止了游戏！<br>';
        }

    }
}






