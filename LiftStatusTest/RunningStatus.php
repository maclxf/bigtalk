<?php
namespace liftstatustest;

use liftstatustest\LiftStatus;
use liftstatustest\Context;

class RunningStatus extends LiftStatus {
    /**
     * 电梯开门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function open() {
        //电梯在跑不能开门
    }

    /**
     * 电梯关门
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function close() {
        //电梯在跑不能关门
    }
    /**
     * 电梯上下运行
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function run() {
        echo '电梯黑起狗子在跑！<br>';
    }
    /**
     * 电梯停止
     * @author lxf 2018-01-24
     * @return [type] [description]
     */
    public function stop() {
        $this->context->setLiftStatus(Context::$StoppingStatus);
        $context = $this->context->getLiftStatus();
        $context->stop();
    }
}