<?php
namespace liftstatustest;

use liftstatustest\LiftStatus;
use liftstatustest\Context;

class OpenningStatus extends LiftStatus {
    /**
     * 电梯开门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function open() {
        // 完成该状态类本身应该完成的事情
        echo '打开电梯门！<br>';
    }

    /**
     * 电梯关门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function close() {
        // 设置为关闭状态
        $this->context->setLiftStatus(Context::$ClosingStatus);
        // 获取到新的设置了状态的类
        $context = $this->context->getLiftStatus();
        // 在执行关闭状态的方法
        $context->close();
    }
    /**
     * 电梯上下运行
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function run() {

    }
    /**
     * 电梯停止
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function stop() {

    }
}