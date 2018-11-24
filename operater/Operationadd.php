<?php

include_once('Operation.php');

class Operationadd extends Operation {

	public function getresult() {
		$ret = $this->first + $this->sec;

		return $ret;
	}

}