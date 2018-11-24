<?php
require_once 'Person.php';

class Student extends Person {
    public function work() {
        echo 'Student is study!';
    }
}