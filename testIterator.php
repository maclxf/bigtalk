<?php
class myIterator implements Iterator {
    private $index = 0;
    private $data = '';

    public function __construct($data) {
        $this->index = 0;
        $this->data = $data;
    }

    function rewind() {
        var_dump(__METHOD__);
        $this->index = 0;
    }

    function current() {
        var_dump(__METHOD__);
        return $this->data[$this->index];
    }

    function key() {
        var_dump(__METHOD__);
        return $this->index;
    }

    function next() {
        var_dump(__METHOD__);
        ++$this->index;
    }

    function valid() {
        var_dump(__METHOD__);
        return isset($this->data[$this->index]);
    }
}

$it = new myIterator(array(
    "hello",
    "php",
    "iterator",
));
foreach($it as $key => $value) {
    echo "$key : $value<br>";
}