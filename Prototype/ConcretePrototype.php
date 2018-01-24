<?php
namespace prototype;
use prototype\IPrototype;

class ConcretePrototype implements IPrototype {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function shallowCopy() {
        return clone $this;
    }

    public function deepCopy() {
        $deep = serialize($this);
        $clone_obj = unserialize($deep);
        return $clone_obj;
    }
}