<?php
require_once 'Reflection/Person.php';

$student = new Person();
echo '<pre>';
// 反射person类
$reflect = new ReflectionClass('person');
// 获取person中的所有属性
// 这里会获取出所有的属性: name,age
// ReflectionProperty::IS_PRIVATE 只获取private 同理其他
// 如果要同时获取public 和private 属性，就这样写：ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED。
$props = $reflect->getProperties();
/**
var_dump($props);
array(2) {
  [0]=>
  object(ReflectionProperty)#3 (2) {
    ["name"]=>
    string(4) "name"
    ["class"]=>
    string(6) "Person"
  }
  [1]=>
  object(ReflectionProperty)#4 (2) {
    ["name"]=>
    string(3) "age"
    ["class"]=>
    string(6) "Person"
  }
}*/
foreach ($props as $prop) {
    // 获取属性的名字
    var_dump($prop->getName());
}
echo '<hr>';

// 获取person中的所有方法
$methods = $reflect->getMethods();
foreach ($methods as $method) {
    var_dump($method->getName());
}
echo '<hr>';

// 这个方法相当于new person的实例
$instance = $reflect->newInstanceArgs();
echo $instance->say();
echo '<hr>';

// 调用say_age这个方法
$obj_say = $reflect->getmethod('say_age');
$obj_say->invoke($instance);
echo '<hr>';

//array(2) { ["name"]=> string(5) "Curry" ["age"]=> int(28) }
var_dump(get_object_vars($student));

echo '<hr>';
//array(1) { ["name"]=> NULL }
var_dump(get_class_vars(get_class($student)));

echo '<hr>';
//array(2) { [0]=> string(3) "say" [1]=> string(4) "_set" }
var_dump(get_class_methods(get_class($student)));

