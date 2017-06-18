<?php
require_once('status/StatusWaitSupervisor.php');


class Context {
    private $status;

    public $refund;

    public function __construct(Status $status){
        $this->status = $status;
    }

    public function set_refund ($refund) {
        $this->refund = $refund;
    }

    public function get_refund() {
        return $this->refund ?? NULL;
    }


    public function do_request($post_data) {
        $this->status->do_some($this, $post_data);
    }

}