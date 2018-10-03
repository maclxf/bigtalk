<?php
namespace TIterator;

abstract class PList {

    protected $list;

    public function __construct(array $list) {
        $this->list = $list;
    }

    public function add(string $name) {
        $this->list[] = $name;
    }

    public function remove(int $index) {
        if (isset($this->list[$index])) {
            unset($this->list[$index]);
        }
    }

    public function getList() {
        return $this->list ?? [];
    }

    abstract public function createIterator();
}
