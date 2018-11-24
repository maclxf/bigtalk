<?php

namespace Component;

class File implements IFile {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add(IFile $f) {
        return false;
    }

    public function remove(IFile $f) {
        return false;
    }

    public function display() {
        echo $this->name;
    }

    public function getChild() {
        return false;
    }
}