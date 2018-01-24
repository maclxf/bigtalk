<?php
namespace liftstatustest;

use liftstatustest\OpenningStatus;
use liftstatustest\ClosingStatus;
use liftstatustest\RunningStatus;
use liftstatustest\StoppingStatus;

class Context {
    public $OpenningStatus;
    public $ClosingStatus;
    public $RunningStatus;
    public $StoppingStatus;

    private $leftstatus;

    public function __construct() {
        $this->OpenningStatus = new OpenningStatus();
        $this->ClosingStatus = new ClosingStatus();
        $this->RunningStatus = new RunningStatus();
        $this->StoppingStatus = new StoppingStatus();
    }

    public function getLiftStatus() {
        return $this->leftstatus;
    }

    public function setLiftStatus(LiftStatus $liftstatus) {
        $this->liftstatus = $liftstatus;
    }

    public function open() {
        return $this->leftstatus->open();
    }

    public function close() {
        return $this->leftstatus->close();
    }

    public function run() {
        return $this->leftstatus->run();
    }

    public function stop() {
        return $this->leftstatus->stop();
    }
}