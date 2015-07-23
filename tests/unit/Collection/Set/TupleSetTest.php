<?php

use Jmw\Collection\Set\TupleSet;
use Jmw\Collection\Lists\Tuple;
class TupleSetTest extends PHPUnit_Framework_TestCase
{
	public $set;
	
	public function setUp()
	{
		$this->set = new TupleSet(['foo'=>'bar','key'=>'baz']);
	}
	
	public function testRemove()
	{
		$changed = $this->set->remove(new Tuple('bah', 'humbug'));
		
		$this->assertFalse($changed);
		
		$tp = new Tuple('foo', 'bar');
		
		$changed = $this->set->remove($tp);
				
		$first = $this->set->iterator()->next();
						
		$this->assertTrue($changed);
	}
	
	/******************************************************
	 ** Exceptional Cases
	 ******************************************************/
	
	/**
	 * @expectedException Jmw\Collection\Exception\InvalidTypeException
	 */
	public function testAddEx()
	{
		$this->set->add('blah');
	}	
}