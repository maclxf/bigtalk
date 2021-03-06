<?php
namespace Handler;

abstract class Handler {
	const FATHER_LEVEL_REQ = 1;
	const HUSBAND_LEVEL_REQ = 2;
	const SON_LEVEL_REQ = 3;

	private $level;

	private $nextHandler;

	public function __construct(int $level) {
		$this->level = $level;
	}

	final public function handlerMessage(IWomen $women) {
		if ($women->getType() === $this->level) {
			$this->response($women);
		} else {
			if ($this->nextHandler != NULL) {
				$this->nextHandler->handlerMessage($women);
			} else {
				echo '---没地方请示了，不同意处理---<br>';
			}
		}
	}

	public function setNext(Handler $handler) {
		$this->nextHandler = $handler;
	}

	abstract protected function response(IWomen $women);
}