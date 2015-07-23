<?php

use Jmw\Collection\Lists\ArrayList;
class ArrayListTest extends PHPUnit_Framework_TestCase
{
	public $list;
	
	public function setUp()
	{
		$this->list = new ArrayList(['a','b','c','d','y','z']);
	}
	
	public function testAdd()
	{
		$list = new ArrayList();
		
		$list->add('g');
		
		$this->assertEquals(1, $list->size());
	}
	
	public function testAddAt()
	{			
		$this->list->addAt(3, 'g');
			
		$this->assertTrue($this->list->equals(new ArrayList(['a','b','c','g','d','y','z'])));
		
		$this->list->addAt(1, 'foo');
			
		$this->assertTrue($this->list->equals(new ArrayList(['a','foo','b','c','g','d','y','z'])));
		
		$list = new ArrayList([new stdClass(), new stdClass()]);
				
		$obj = new stdClass();
		
		$obj->value = 'foobar';
		
		$list->addAt(1, $obj);
				
		$this->assertEquals(1, $list->indexOf($obj));
	}
	
	public function testAddAll()
	{
		$this->list->addAll(new ArrayList(['f','w']));
		
		$this->assertEquals(new ArrayList(['a','b','c','d','y','z','f','w']), $this->list);
		$this->assertNotEquals(new ArrayList(['a','b','c','d','y','z','w']), $this->list);
	}

	public function testClear()
	{
		$this->list->clear();
		
		$this->assertEquals(new ArrayList(), $this->list);
	}
	
	public function testContains()
	{
		$this->assertTrue($this->list->contains('c'));
		$this->assertTrue($this->list->contains('a'));
		$this->assertTrue($this->list->contains('z'));
		
		$this->assertFalse($this->list->contains('foo'));
		$this->assertFalse($this->list->contains('bar'));
		$this->assertFalse($this->list->contains('baz'));
	}

	public function testContainsAll()
	{	
		$this->assertTrue($this->list->containsAll(new ArrayList(['c','y'])));
		$this->assertFalse($this->list->containsAll(new ArrayList(['c','xyz'])));
	}

	public function testEquals()
	{	
		$this->assertTrue($this->list->equals(new ArrayList(['a','b','c','d','y','z'])));
		$this->assertFalse($this->list->equals(new ArrayList(['a','b','c','d','q','z'])));
		$this->assertFalse($this->list->equals(new ArrayList(['a','b','c','d','y'])));
	}
	
	public function testGet()
	{
		$element = $this->list->get(3);
		
		$this->assertEquals('d', $element);
	}
	
	public function testIsEmpty()
	{
		$list = new ArrayList();
		
		$this->assertTrue($list->isEmpty());
		
		$this->assertFalse($this->list->isEmpty());
	}
	
	public function testIndexOf()
	{
		$index = $this->list->indexOf('a');
		
		$this->assertEquals(0, $index);
	}
	
	public function testIterator()
	{
		$iterator = $this->list->iterator();
		
		$count = 0;
		while($iterator->hasNext())
		{
			$iterator->next();
			if($count % 2 === 0)
			{
				$iterator->remove();
			}
			$count++;
		}
		
		$this->assertEquals(new ArrayList(['b','d','z']), $this->list);
	}
	
	public function testLastIndexOf()
	{
		$this->list->add('b');
		
		$index = $this->list->lastIndexOf('b');
		
		$this->assertEquals(6, $index);
		
		$this->list->removeAt($index);
		
		$index = $this->list->lastIndexOf('b');
		
		$this->assertEquals(1, $index);
		
		$index = $this->list->lastIndexOf('foo');
		
		$this->assertEquals(-1, $index);
	}
	
	public function testListIteratorAt()
	{
		$iterator = $this->list->listIteratorAt(3);
		
		$tailElems = [];
		
		while($iterator->hasNext())
		{
			$tailElems[] = $iterator->next();
		}
		
		$this->assertEquals(['d','y','z'], $tailElems);
	}
	
	public function testRemove()
	{
		$this->list->remove('d');
		
		$this->assertEquals(new ArrayList(['a','b','c','y','z']), $this->list);
		
		$this->assertFalse($this->list->remove('notinlist'));
	}
	
	public function testRemoveAll()
	{
		$this->list->removeAll(new ArrayList(['b','c','z']));
		
		$this->assertEquals(new ArrayList(['a','d','y']), $this->list);
	}
	
	public function testRemoveAt()
	{
		$this->list->removeAt(4);
		
		$this->assertEquals(new ArrayList(['a','b','c','d','z']), $this->list);
	}

	public function testRemoveRange()
	{	
		$this->list->removeRange(2, 5);
	
		$this->assertTrue($this->list->equals(new ArrayList(['a','b','z'])));
	}
	
	public function testRetainAll()
	{
		$retain = new ArrayList(['a','y','z']);
		
		$this->list->retainAll($retain);
		
		$this->assertEquals($retain, $this->list);
	}
	
	public function testSize()
	{		
		$this->assertEquals(6, $this->list->size());
	}

	
	public function testSet()
	{		
		$this->list->add('g');
		
		$this->list->set(4, 'q');
		
		$this->assertEquals('q', $this->list->get(4));		
	}
	
	public function testSubList()
	{		
		$this->list = $this->list->subList(2, 5);

		$this->assertTrue($this->list->equals(new ArrayList(['c','d','y'])));
	}
	
	public function testToJson()
	{
		$json = $this->list->toJson();
		
		$this->assertEquals('["a","b","c","d","y","z"]', $json);
	}
	
	/******************************************************
	 ** Exceptional Cases
	 ******************************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\InvalidTypeException
	 */
	public function testConstructEx()
	{
		new ArrayList(123);
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\IndexOutOfBoundsException
	 */
	public function testGetEx()
	{
		$this->list->get(147);
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\IndexOutOfBoundsException
	 */
	public function testRemoveAtEx()
	{
		$this->list->removeAt(147);
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\IndexOutOfBoundsException
	 */
	public function testSetEx()
	{
		$this->list->set(147, 'q');
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\InvalidTypeException
	 */
	public function testCheckIntEx()
	{
		$this->list->addAt('aHA!', 'foo');
	}
}