<?php
require_once __DIR__ . '/vendor/autoload.php';

include_once('dress_v1/Person.php');
include_once('dress_v1/DressA_v1.php');
include_once('dress_v1/DressB_v1.php');

use PHPUnit\Framework\TestCase;

Class DressTest extends TestCase {
	public function test() {

		$person = new Person();
		$person->name('笑帅');
	}
}
