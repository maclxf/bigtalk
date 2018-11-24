<?php

include_once('Icomponent.php');


// 理解为人类
class Concretecomponent implements Icomponent {
	public function operation () {
		echo '我穿的是';
	}
}

// 这里是extends还是implements,答应该用implement不能用extends
// 报错Fatal error: Class Concretecomponent cannot extend from interface Icomponent
// 接口是否一定是要抽象类才能实现，可否用实际类来实现 应该时可以因为接口是个特殊的抽象类这里就是用实际类实现的