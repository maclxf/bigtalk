<?php
require_once ('dif_self_static/Car.php');

class TaxiStatic extends Car {
    protected static function getmodel() {
        echo 'This is taxi.';
    }
}