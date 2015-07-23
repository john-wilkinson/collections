<?php

use Jmw\Collection\Set\HashSet;
use Jmw\Collection\Lists\ArrayList;
class HashSetTest extends PHPUnit_Framework_TestCase
{
	public $set;
	
	public function setUp()
	{
		$this->set = new HashSet(['hello', 'world', '!']);
	}
	
	public function testIterate()
	{		
		$iterator = $this->set->iterator();
		
		while($iterator->hasNext())
		{
			$element = $iterator->next();
			$iterator->remove();
		}
	}
	
	public function testAdd()
	{
		$this->set->add('aha!');
		$this->assertEquals(4, $this->set->size());
		$this->set->add('world');
		$this->assertEquals(4, $this->set->size());
	}
	
	public function testRemoveAllSmaller()
	{
		$this->set->removeAll(new ArrayList(['hello', 'world', 'foo', 'bar']));
		
		$this->assertEquals(1, $this->set->size());
	}
	
	public function testRemoveAllLarger()
	{
		$this->set->removeAll(new ArrayList(['hello', 'world']));
	
		$this->assertEquals(1, $this->set->size());
	}
	
	public function testHashCode()
	{
		$code = $this->set->hashCode();
		
		$expected = (new HashSet(['hello', 'world', '!']))->hashCode();
		
		$this->assertEquals($expected, $code);
	}
}