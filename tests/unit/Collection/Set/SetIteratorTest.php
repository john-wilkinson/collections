<?php
use Jmw\Collection\Set\HashSet;
class SetIteratorTest extends PHPUnit_Framework_TestCase
{
	public $iterator;
	
	public $set;
	
	public function setUp()
	{
		$this->set = new HashSet(['hello', 'world', '!']);
		
		$this->iterator = $this->set->iterator();
	}
	
	/******************************************************
	 ** Exceptional Cases
	 ******************************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testNextEx()
	{
		$this->iterator->next();
		$this->iterator->next();
		$this->iterator->next();
		$this->iterator->next();
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\IllegalStateException
	 */
	public function testRemoveEx()
	{
		$this->iterator->remove();
	}
	
}