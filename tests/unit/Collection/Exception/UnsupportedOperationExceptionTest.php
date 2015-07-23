<?php
use Jmw\Collection\Exception\UnsupportedOperationException;
class UnsupportedOperationExceptionTest extends PHPUnit_Framework_TestCase
{
	public $e;
	
	public function setUp()
	{
		$this->e = new UnsupportedOperationException('add');
	}
	
	public function testGetOperation()
	{
		$this->assertEquals('add', $this->e->getOperation());
	}
}