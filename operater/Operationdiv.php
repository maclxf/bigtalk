<?php

include_once('Operation.php');

class Operationdiv extends Operation {

	public function getresult() {
		if ($this->sec != 0) {
			$ret = $this->first  / $this->sec;

			return $ret;
		} else {
			return '被除数不能为0！';
		}
	}
}




