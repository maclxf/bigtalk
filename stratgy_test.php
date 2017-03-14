<?php
require_once('stratgy/StratgyContent.php');
require_once('stratgy/OnlyCash.php');
require_once('stratgy/CashReturn.php');
require_once('stratgy/CashDiscount.php');

// 策略模式
$ck = 3;
$cc = '';
switch ($ck) {
	case 1:
		$cc = new OnlyCash();
		break;
	case 2:
		$cc = new CashReturn();
		break;
	case 3:
		$cc = new CashDiscount();
		break;

	default:
		# code...
		break;
}

$invoke_obj = new StratgyContent($cc);

$invoke_obj->invokestratgy();

// 关于策略模式
// 1. 封装的是算法
//  2. 上下文类通过构造类传入一个指定的接口类
//  3. 然后这个上下文类将调用执行方法，而具体那个执行就是由这个指定的接口类来实现的
//  4. 这个接口类是由其子类来具体实现
//
//
//  工厂模式是创建型模式 一个关注对象创建      工厂模式是生成型的模式，在你需要的时候构建具体的实例，工厂模式需要知道具体的操作方法
//  策略模式是行为性模式 一个关注行为的封装  策略模式就是定义一系列的算法，这些算法可以在需要的时候替换和扩展，策略模式
//
//  如果你是想根据不同对象调用同样方法，就用工厂，如果你是想对一个对象，调用不同方法，就用策略
//
//  当你的工厂需要加工其它的东西时，你需要修改你的工厂类。但是如果用策略模式，就不必修改你的Context.
//
//   简单工厂模式 中我们 只需要传递相应的条件就能得到想要的一个对象（告诉别人我要干嘛、别人去做） ，然后通过这个对象实现算法的操作。而 策略模式 ，使用时 必须首先创建一个想使用的类对象（自己去 做） ，然后将该对象最为参数传递进去，通过该对象调用不同的算法。在简单工厂模式中实现了通过条件选取一个类去实例化对象，策略模式则将选取相应对象的工作交给模式的使用者，它本身不去做选取工作。