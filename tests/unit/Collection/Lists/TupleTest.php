<?php

use Jmw\Collection\Lists\Tuple;
use Jmw\Collection\Lists\ArrayList;
class TupleTest extends PHPUnit_Framework_TestCase
{
	public $tuple;
	
	public function setUp()
	{
		$this->tuple = new Tuple('a','b','c');
	}
	
	public function testIterator()
	{
		$this->assertInstanceOf('Jmw\Collection\IteratorInterface', $this->tuple->iterator());
	}
	
	public function testEquals()
	{
		$this->assertTrue($this->tuple->equals(new Tuple('a','b','c')));
		$this->assertFalse($this->tuple->equals(new Tuple('a','b','d')));
		$this->assertFalse($this->tuple->equals('garbage'));
	}
	
	public function testGet()
	{
		$this->assertEquals('a', $this->tuple->get(0));
	}
	
	public function testIndexOf()
	{
		$this->assertEquals(1, $this->tuple->indexOf('b'));
	}
	
	public function testLastIndexOf()
	{
		$this->assertEquals(1, $this->tuple->lastIndexOf('b'));
	}
	
	public function testListIterator()
	{
		$this->assertInstanceOf('Jmw\Collection\Lists\ListIterator', $this->tuple->listIterator());
	}
	
	public function testListeratorAt()
	{
		$this->assertInstanceOf('Jmw\Collection\Lists\ListIterator', $this->tuple->listIteratorAt(1));
	}
	
	public function testSize()
	{
		$this->assertEquals(3, $this->tuple->size());
	}
	
	public function testSubList()
	{
		$expected = new ArrayList(['b','c']);
		$this->assertEquals($expected, $this->tuple->subList(1, 3));
	}
	
	public function testToArray()
	{
		$this->assertEquals(['a','b','c'], $this->tuple->toArray());
	}
	
	public function testToJson()
	{
		$this->assertEquals('["a","b","c"]', $this->tuple->toJson());
	}
	
	public function testOffsetExists()
	{
		$this->assertTrue(isset($this->tuple[0]));
		$this->assertFalse(isset($this->tuple[-1]));
		$this->assertFalse(isset($this->tuple[100]));
		$this->assertFalse(isset($this->tuple['banana']));
	}

	public function testOffsetGet()
	{
		$this->assertEquals('c', $this->tuple[2]);
	}


	/********************************************
	 ** Exceptional cases
	********************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testTupleAddEx()
	{		
		$this->tuple->add('q');
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testAddAllEx()
	{
		$this->tuple->addAll(new ArrayList());		
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testAddAtEx()
	{
		$this->tuple->addAt(0, 'a');
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testClearEx()
	{
		$this->tuple->clear();
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testRemoveEx()
	{
		$this->tuple->remove('a');
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testRemoveAllEx()
	{
		$this->tuple->removeAll(new ArrayList());
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testRemoveAtEx()
	{
		$this->tuple->removeAt(0);
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testRetainAll()
	{
		$this->tuple->retainAll(new ArrayList());
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testSetEx()
	{
		$this->tuple->set(1, 'z');
	}
	
	/**
	 * @expectedException Exception
	 */
	public function testToJsonEx()
	{
		$tuple = new Tuple("\xB1\x31");
		$tuple->toJson();
	}

	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testOffsetSet()
	{
		$this->tuple[3] = 'q';
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\UnsupportedOperationException
	 */
	public function testOffsetUnset()
	{
		unset($this->tuple[2]);
	}
	
	
}