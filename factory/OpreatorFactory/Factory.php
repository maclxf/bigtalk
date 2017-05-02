<?php

abstract class Factory {
	abstract public function OpreatorCreater();
}

// 这时一个工厂抽象类
//
// 每实例一个具体对象的方法都应该是一个继承于这个类的对象来调用的
// 要现实一个方法，都应当先创建一个该方法对应的工厂，而这个工厂应该继承于这个抽象类