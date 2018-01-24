<?php
namespace liftstatustest;
use liftstatustest\Context;

abstract class LiftStatus {
    // 环境角色
    protected $context;

    public function setContext(Context $context) {
        $this->context = $context;
    }

    /**
     * 电梯开门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    abstract public function open();
    /**
     * 电梯关门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    abstract public function close();
    /**
     * 电梯上下运行
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    abstract public function run();
    /**
     * 电梯停止
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    abstract public function stop();
}