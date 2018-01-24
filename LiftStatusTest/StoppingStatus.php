<?php
namespace liftstatustest;

use liftstatustest\LiftStatus;
use liftstatustest\Context;

class StoppingStatus extends LiftStatus {
    /**
     * 电梯开门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function open() {
        $this->context->setLiftStatus(Context::$OpenningStatus);
        $context = $this->context->getLiftStatus();
        $context->open();
    }

    /**
     * 电梯关门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function close() {

    }
    /**
     * 电梯上下运行
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function run() {
        $this->context->setLiftStatus(Context::RunningStatus);
        $context = $this->context->getLiftStatus();
        $context->run();
    }
    /**
     * 电梯停止
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function stop() {
        echo '哦或，电梯熄火了!<br>';
    }
}