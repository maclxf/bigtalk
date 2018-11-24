<?php
	include_once('operater/Choseoperater.php');

	$action = '*';
	$number1 = '3';
	$number2 = '2';

	$choseoperater = new Choseoperater($number1, $number2);

	if ($choseoperater) {
		$operater = $choseoperater->getoperater($action);

		if ($operater) {
			echo $operater->getresult($number1, $number2);
		} else {
			echo '请你算算！！';
		}
	} else {
		echo '要我按照哪个方法算？';
	}

	// 简单工厂模式
	// 1. 简单计算器
	// 类名和类所在的文件名要一致，并且是大驼峰写法
	// 哪个类接受哪些参数比如Choseoperater类在new时就要接受两个参数，而起getresult方法接受一个参数
	// 一个文件只该做一件事情要么声明要么处理逻辑，这里最初的写法就是把所有类抽象类，子类，都写在一个文件内了
	// 关于包含你要用哪个类就要包含那个文件
	// 对象在初始化的时候就要赋值，那么应该在构造函数的参数要有默认值（以免加载时就报错）
	// 简单工厂模式：
		// 抽象基类：类中定义抽象一些方法，用以在子类中实现
		// 继承自抽象基类的子类：实现基类中的抽象方法
		// 工厂类：用以实例化对象