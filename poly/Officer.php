<?php
require_once 'Person.php';

class Officer extends Person {
    public function work() {
        echo 'Officer is working!';
    }
}