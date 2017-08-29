<?php
namespace observer;
// 观察者类
Interface Iobserver {
    /**
     * 当通知者的状态发生变化，观察者应当做出相应的操作
     * @author lxf 2017-08-24
     * @return [type] [description]
     */
    public function update();
}






