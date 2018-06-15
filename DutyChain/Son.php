<?php
namespace Handler;
use Handler\handler

class Son extends Handler {
	public function __construct() {
		parent::__construct(parent::SON_LEVEL_REQ);
	}

	public function response(IWomen $women) {
		echo '---女儿向父亲请示---<br>';

		echo $women->getRequest();

		echo '---儿子的答案是：同意---<br>';
	}
}


渠道
	等待获取
	获取中
	已获取

	获取失败
