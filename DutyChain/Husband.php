<?php
namespace Handler;
use Handler\handler;

class Husband extends Handler {
	public function __construct() {
		parent::__construct(parent::HUSBAND_LEVEL_REQ);
	}

	public function response(IWomen $women) {
		echo '---女儿向父亲请示---<br>';

		echo $women->getRequest();

		echo '---丈夫的答案是：同意---<br>';
	}
}