<?php
# 普通遍历

# 2. 遍历解包

$arr = [
    [66, 88],
    [99]
];
try {
    foreach ($arr as list($a1)) {
        echo $a1 . PHP_EOL;
    }
} catch(Exception $e) {
    echo $e->getMessage();
}

echo PHP_EOL;

# 3. 遍历对象
class MyClass
{
    public $var1 = 1;
    public $var2 = 2;
    public $var3 = 3;

    protected $protected = 'protected kkk';
    private $private = 'private bbb';

    public function iteratorFun() {
        echo __FUNCTION__ . "aa".PHP_EOL;
        foreach ($this as $key => $value) {
            echo "$key => $value" . PHP_EOL;
        }
    }
}


$class = new Myclass();
# 3.2 外部可以遍历公告属性
foreach ($class as $key => $value) {
    echo "$key => $value" . PHP_EOL;
}

# 3.3. 内部才能访问非公共的属性
$class->iteratorFun();

echo PHP_EOL;

# 4 实现 Iterator 接口 对象遍历
class IteratorArr implements Iterator {
    private $arr;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    public function current()
    {
        echo __FUNCTION__ . current($this->arr) . PHP_EOL;
    }

    public function next() {
        echo __FUNCTION__ . next($this->arr) . PHP_EOL;
    }

    public function key() {
        echo __FUNCTION__ . key($this->arr) . PHP_EOL;
    }

    public function valid()
    {
        echo __FUNCTION__ . PHP_EOL;
        return current($this->arr) !== false;
    }

    public function rewind()
    {
        reset($this->arr);
        echo __FUNCTION__ . PHP_EOL;
    }
}

$b = [
    32,21,62
];

$obj = new IteratorArr($b);

foreach ($obj as $key => $value) {
    echo $key . $value . PHP_EOL;
}
/*
rewind
valid
key 0
current 32
next

*/


# 5. 通过实现IteratorAggregate 遍历对象

# 6. 生成器