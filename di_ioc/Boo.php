<?php
//namespace di_ioc;

class Boo {

    private $bim;
    public function __construct(Bim $bim) {
        $this->bim = $bim;
    }

    public function do_anything() {
        $this->bim->do_anything();
        echo __CLASS__ . ' is doing ...<br>';
    }
}