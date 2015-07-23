<?php

use Jmw\Collection\Exception\InvalidTypeException;
class InvalidTypeExceptionTest extends PHPUnit_Framework_TestCase
{
	public $e;
	
	public function setUp()
	{
		$this->e = new InvalidTypeException('int', 'string');
	}
	
	public function testGetExpected()
	{
		$this->assertEquals('int', $this->e->getExpected());
	}
	
	public function testGetReceived()
	{
		$this->assertEquals('string', $this->e->getReceived());
	}
}