<?php

class Car {
    public static function model() {
        //static::getmodel();
        self::getmodel();
    }

    protected static function getmodel() {
        echo 'This is car.';
    }
}