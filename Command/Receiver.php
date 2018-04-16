<?php
namespace command;

abstract class Receiver {

    abstract public function find();
    abstract public function add();
    abstract public function delete();
    abstract public function plan();
}