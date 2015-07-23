<?php
use Jmw\Collection\Set\ArraySet;
class ArraySetTest extends PHPUnit_Framework_TestCase
{
	public $set;
	
	public function setUp()
	{
		$this->set = new ArraySet(['a','b','c']);
	}
	
	public function testRemove()
	{
		$this->set->remove('b');
				
		$this->assertEquals(2, $this->set->size());
	}
}