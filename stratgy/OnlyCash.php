<?php
require_once('stratgy/Checkout.php');
class OnlyCash extends Checkout {

    public function checkout_confirm() {
    	echo '复现';
    }

}