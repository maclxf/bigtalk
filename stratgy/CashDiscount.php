<?php

require_once('stratgy/Checkout.php');

class CashDiscount extends Checkout {

    public function checkout_confirm() {
    	echo '折扣';
    }

}