<?php
namespace statuspattern;

interface Status {
    public function do_some(Context $context, $new_status);

}