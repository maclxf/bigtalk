<?php

require_once('stratgy/Checkout.php');

class CashReturn extends Checkout {

    public function checkout_confirm() {
    	echo '返现';
    }

}