<?php
namespace statuspattern;
use statuspattern\Status

class StatusPass implements Status {
    protected $deal_status;
    public function __construct() {
        $this->deal_status = array(11);
    }

    public function do_some(Context $context, $new_status) {

        if(in_array($context->refund['status'], $this->deal_status)) {
            echo '财务审核通过了';
        }
    }

}