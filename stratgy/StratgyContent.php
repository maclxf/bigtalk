<?php


class StratgyContent {
	protected $stratgy;

	public function __construct(checkout $stratgy) {
		$this->stratgy = $stratgy;
	}

	public function invokestratgy() {
		$this->stratgy->checkout_confirm();
	}
}


