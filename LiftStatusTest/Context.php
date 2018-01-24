<?php
namespace liftstatustest;

use liftstatustest\OpenningStatus;
use liftstatustest\ClosingStatus;
use liftstatustest\RunningStatus;
use liftstatustest\StoppingStatus;

class Context {
    // 注意访问变量和访问静态属性的区别self::$OpenningStatus
    public static $OpenningStatus = NULL;
    public static $ClosingStatus = NULL;
    public static $RunningStatus = NULL;
    public static $StoppingStatus = NULL;
    // 注意访问变量和访问静态属性的区别$this->liftstatus
    private $liftstatus;

    public function __construct() {
        self::$OpenningStatus = new OpenningStatus();
        self::$ClosingStatus = new ClosingStatus();
        self::$RunningStatus =  new RunningStatus();
        self::$StoppingStatus = new StoppingStatus();
    }

    public function getLiftStatus() {
        return $this->liftstatus;
    }

    public function setLiftStatus(LiftStatus $liftstatus) {
        $this->liftstatus = $liftstatus;
        $this->liftstatus->setContext($this);
    }

    public function open() {
        return $this->liftstatus->open();
    }

    public function close() {
        return $this->liftstatus->close();
    }

    public function run() {
        return $this->liftstatus->run();
    }

    public function stop() {
        return $this->liftstatus->stop();
    }
}