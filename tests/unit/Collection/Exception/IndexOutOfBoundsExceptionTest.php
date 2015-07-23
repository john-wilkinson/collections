<?php

use Jmw\Collection\Exception\IndexOutOfBoundsException;
class IndexOutOfBoundsExceptionTest extends PHPUnit_Framework_TestCase
{
	public $e;
	
	public function setUp()
	{
		$this->e = new IndexOutOfBoundsException(47);
	}
	
	public function testGetIndex()
	{
		$this->assertEquals(47, $this->e->getIndex());
	}
}