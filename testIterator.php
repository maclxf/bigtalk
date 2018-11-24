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

while ($it->valid()) {
    echo $it->current() . '<br>';
    $it->next();
}

/*class myStringIterator implements Iterator {
    public $string;
    public function __construct($string)
    {
        $this->string = $this->strToArray($string);
    }
    private function strToArray($string, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($string, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($string, $i, $l, "UTF-8");
            }
            return $ret;
        }
        return preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY);
    }
    public function current()
    {
        return current($this->string);
    }
    public function next()
    {
        return next($this->string);
    }
    public function key()
    {
        key($this->string);
    }
    public function valid()
    {
        if(key($this->string) === null) {
            return false;
        } else {
            return true;
        }
    }
    public function rewind()
    {
        reset($this->string);
    }
}

$string = new myStringIterator('这个是什么213jdjlf');

foreach ($string as $k => $v) {
    echo $v."\n";
}*/