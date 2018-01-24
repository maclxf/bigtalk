<?php
namespace prototype;

interface IPrototype {
    public function shallowCopy();
    public function deepCopy();
}