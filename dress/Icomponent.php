<?php


interface Icomponent {

	public function operation();

}

// 接口中每个方法的权限？答接口中定义的所有方法都必须是公有，这是接口的特性。
// 接口中的方法都不用abstract来说明是抽象方法？ 和定义一个标准的类一样，只不过方法提内必须是空