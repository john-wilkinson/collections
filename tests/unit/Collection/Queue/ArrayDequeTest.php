<?php
use Jmw\Collection\Queue\ArrayDeque;
class ArrayDequeTest extends PHPUnit_Framework_TestCase
{
	public $deque;
	
	public function setUp()
	{
		$this->deque = new ArrayDeque(['a','b','c','d','y','z']);
	}
	
	public function testAddFirst()
	{
		$this->deque->addFirst('first');
		
		$this->assertEquals(new ArrayDeque(['first','a','b','c','d','y','z']), $this->deque);
	}
	
	public function testAddLast()
	{
		$this->deque->addLast('last');
		
		$this->assertEquals(new ArrayDeque(['a','b','c','d','y','z','last']), $this->deque);
	}
	
	public function testDescendingIterator()
	{
		$iter = $this->deque->descendingIterator();
		
		while($iter->hasNext())
		{
			$item = $iter->next();
			$iter->remove();
		}
		
		$this->assertTrue($this->deque->isEmpty());
	}
	
	public function testElement()
	{
		$element = $this->deque->element();
		
		$this->assertEquals('a', $element);
	}
	
	public function testGetLast()
	{
		$last = $this->deque->getLast();
		
		$this->assertEquals('z', $last);
	}
	
	public function testOffer()
	{
		$this->deque->offer('element');
		
		$this->assertEquals(new ArrayDeque(['a','b','c','d','y','z','element']), $this->deque);
	}
	
	public function testOfferFirst()
	{
		$this->deque->offerFirst('q');
		
		$this->assertEquals(new ArrayDeque(['q','a','b','c','d','y','z']), $this->deque);
	}
	
	public function testPeek()
	{
		$element = $this->deque->peek();
		
		$this->assertEquals('a',$element);
	}
	
	public function testPeekFirst()
	{
		$this->deque->clear();
		$element = $this->deque->peekFirst();
	
		$this->assertNull($element);
	}
	
	public function testPeekLast()
	{
		$element = $this->deque->peekLast();
		
		$this->assertEquals('z', $element);
		
		$deque = new ArrayDeque();
		
		$this->assertNull($deque->peekLast());
	}
	
	public function testPoll()
	{
		$element = $this->deque->poll();
		
		$this->assertEquals('a', $element);
		$this->assertEquals(new ArrayDeque(['b','c','d','y','z']), $this->deque);
	}
	
	public function testPollFirst()
	{
		$element = $this->deque->pollFirst();
		
		$this->assertEquals('a', $element);
		$this->assertEquals(new ArrayDeque(['b','c','d','y','z']), $this->deque);
		
		$this->deque->clear();
		
		$this->assertNull($this->deque->pollFirst());
	}
	
	public function testPollLast()
	{
		$element = $this->deque->pollLast();
		
		$this->assertEquals('z', $element);
		$this->assertEquals(new ArrayDeque(['a','b','c','d','y']), $this->deque);

		$this->deque->clear();
		
		$this->assertNull($this->deque->pollLast());
	}
	
	public function testPop()
	{
		$element = $this->deque->pop();
		
		$this->assertEquals('a', $element);
		$this->assertEquals(new ArrayDeque(['b','c','d','y','z']), $this->deque);
	}
	
	public function testPush()
	{
		$this->deque->push('q');
		
		$this->assertEquals(new ArrayDeque(['q','a','b','c','d','y','z']), $this->deque);
	}
	
	public function testRemoveHead()
	{
		$element = $this->deque->removeHead();
		
		$this->assertEquals('a', $element);
		$this->assertEquals(new ArrayDeque(['b','c','d','y','z']), $this->deque);
	}
	
	public function testRemoveFirst()
	{
		$element = $this->deque->removeFirst();
		
		$this->assertEquals('a', $element);
		$this->assertEquals(new ArrayDeque(['b','c','d','y','z']), $this->deque);
	}
	
	public function testRemoveFirstOccurrence()
	{
		$changed = $this->deque->removeFirstOccurrence('d');
		
		$this->assertTrue($changed);
		$this->assertEquals(new ArrayDeque(['a','b','c','y','z']), $this->deque);
	}
	
	public function testRemoveLast()
	{
		$element = $this->deque->removeLast();
		
		$this->assertEquals('z', $element);
		$this->assertEquals(new ArrayDeque(['a','b','c','d','y']), $this->deque);
	}
	
	public function testRemoveLastOccurrence()
	{
		$changed = $this->deque->removeLastOccurrence('d');
		
		$this->assertTrue($changed);
		$this->assertEquals(new ArrayDeque(['a','b','c','y','z']), $this->deque);
	}
	
	/******************************************************
	 ** Exceptional Cases
	******************************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testElementEx()
	{
		$this->deque->clear();
		$this->deque->element();
	}
	

	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testGetFirstEx()
	{
		$this->deque->clear();
		$this->deque->getFirst();
	}

	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testGetLastEx()
	{
		$this->deque->clear();
		$this->deque->getLast();
	}
	
	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testRemoveHeadEx()
	{
		$this->deque->clear();
		$this->deque->removeHead();
	}

	/**
	 * @expectedException Jmw\Collection\Exception\NoSuchElementException
	 */
	public function testRemoveLastEx()
	{
		$this->deque->clear();
		$this->deque->removeLast();
	}
}