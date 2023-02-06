<?php
namespace statuspattern;
use statuspattern\Status;
use statuspattern\StatusPass;
use statuspattern\StatusNotPass;

class StatusWaitFinance implements Status {
    protected $deal_status;
    public function __construct() {
        $this->deal_status = array(10);
    }

    public function do_some(Context $context, $new_status) {

        if(in_array($context->refund['status'], $this->deal_status)) {
            echo '我可以处理等待财务审核状态';
        } else if($context->refund['status'] == 11) {
            $pass_context = new Context(new StatusPass());
            $pass_context->set_refund($context->refund);
            $pass_context->do_request($new_status);
        } else if ($context->refund['status'] == 2) {
            $not_pass_context = new Context(new StatusNotPass());
            $not_pass_context->set_refund($context->refund);
            $not_pass_context->do_request($new_status);
        }
    }
}