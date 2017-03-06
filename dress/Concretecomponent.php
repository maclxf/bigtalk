<?php

include_once('Icomponent.php');

// 这里是extends还是implements
class Concretecomponent implements Icomponent {
	public function operation () {
		echo '我穿什么衣服！'
	}
}