<?php

include_once('Icomponent.php');


// 理解为人类
class Concretecomponent implements Icomponent {
	public function operation () {
		echo '我穿的是';
	}
}

// 这里是extends还是implements
// 接口是否一定是要抽象类才能实现，可否用实际类来实现
//