<?php

require_once './factory/OpreatorFactory/Factory.php';
require_once './factory/Opreator/AddOpreator.php';

class AddFactory extends Factory {
    // 这里包裹错
    //Fatal error: Declaration of AddFactory::OpreatorCreater($NumberA, $NumberB) must be compatible with Factory::OpreatorCreater() in E:\project\bigtalk\factory\OpreatorFactory\AddFactory.php on line 6
    //因为子类继承父类的方法必须和父类的方法一致，这里是因为子类的方法有了参数，而父类的方法没有参数，那么此时设置子类的方法默认为空才行
	public function OpreatorCreater($NumberA = NULL, $NumberB = NULL) {
		return new AddOpreator($NumberA, $NumberB);
	}
}