<?php
namespace Handler;
use Handler\handler

class Father extends Handler {
	public function __construct() {
		parent::__construct(parent::FATHER_LEVEL_REQ);
	}

	public function response(IWomen $women) {
		echo '---女儿向父亲请示---<br>';

		echo $women->getRequest();

		echo '---父亲的答案是：同意---<br>';
	}
}