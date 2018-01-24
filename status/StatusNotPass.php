<?php
namespace statuspattern;
use statuspattern\Status;

class StatusNotPass implements Status {
    protected $deal_status;
    public function __construct() {
        $this->deal_status = array(2);
    }

    public function do_some(Context $context, $new_status) {

        if(in_array($context->refund['status'], $this->deal_status)) {
            echo '财务审核没通过';
        }
    }

}