<?php
namespace statuspattern;
use statuspattern\Status;
use statuspattern\StatusWaitFinance;
use statuspattern\StatusNotPass;


class StatusWaitSupervisor implements Status {
    protected $deal_status;

    public function __construct() {
        $this->deal_status = array(0);
    }

    public function do_some(Context $context, $new_status) {

        if(in_array($context->refund['status'], $this->deal_status)) {
            echo '我可以处理等待主管审核状态';
        } else if ($context->refund['status'] == 10) {
            $finance_context = new Context(new StatusWaitFinance());
            $finance_context->set_refund($context->refund);
            $finance_context->do_request($new_status);
        } else if ($context->refund['status'] == 2) {
            $not_pass_context = new Context(new StatusNotPass());
            $not_pass_context->set_refund($context->refund);
            $not_pass_context->do_request($new_status);
        }
    }

}