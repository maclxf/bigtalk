<?php
require_once('d:/projects/bigtalk/vendor/phpunit/phpunit/PHPUnit/Framework/TestCase.php');
class SubjectTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeAdd()
    {
        require_once('../observer/Subject.php');
        $a = new Subject();

        $this->assertEquals($b = $a->add_observer(new Concreteobserver()));
    }
}