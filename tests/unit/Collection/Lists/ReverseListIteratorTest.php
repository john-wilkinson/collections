<?php
use Jmw\Collection\Lists\ReverseListIterator;
use Jmw\Collection\Lists\ArrayList;
class ReverseListIteratorTest extends PHPUnit_Framework_TestCase
{
	public $iterator;

	public $list;

	public function setUp()
	{
		$this->list = new ArrayList(['a','b','c']);
		$this->iterator = new ReverseListIterator($this->list);
	}

	public function testHasNext()
	{
		$this->assertTrue($this->iterator->hasNext());
	
		$this->iterator->next();
		$this->iterator->next();
		$this->iterator->next();
	
		$this->assertFalse($this->iterator->hasNext());
	}
	
	public function testNext()
	{
		$this->assertEquals('c', $this->iterator->next());
	}
	
	public function testRemove()
	{
		$this->iterator->next();
		$this->iterator->remove();
	
		$this->assertEquals(2, $this->list->size());
	}
	
	/********************************************
	 ** Exceptional cases
	********************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testNextEx()
	{
		while(true)
		{
			$this->iterator->next();
		}
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\IllegalStateException
	 */
	public function testRemoveEx()
	{
		$this->iterator->remove();
	}
}