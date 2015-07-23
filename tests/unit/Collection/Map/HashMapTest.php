<?php

use Jmw\Collection\Map\HashMap;
use Jmw\Collection\Lists\ArrayList;
use Jmw\Collection\Set\ArraySet;
class HashMapTest extends PHPUnit_Framework_TestCase
{
	public $map;
	
	public function setUp()
	{
		$this->map = new HashMap([
			'foo'	=> 'bar',
			'by'	=> 'baz',
			'bob'	=> 'frank'
		]);
	}
	
	public function testClear()
	{
		$this->map->clear();
		$this->assertTrue($this->map->isEmpty());
	}
	
	public function testContainsKey()
	{
		$this->assertTrue($this->map->containsKey('foo'));
		$this->assertFalse($this->map->containsKey('no'));
	}
	
	public function testContainsValue()
	{
		$this->assertTrue($this->map->containsValue('bar'));
		$this->assertFalse($this->map->containsValue('no'));
	}
	
	public function testEntrySet()
	{
		$set = $this->map->entrySet();
	}
	
	public function testEquals()
	{
		$this->assertTrue($this->map->equals($this->map));
	}
	
	public function testGet()
	{
		$this->assertEquals('baz', $this->map->get('by'));
		
		$this->assertNull($this->map->get('no'));
	}
	
	public function testHashCode()
	{
		$code = $this->map->hashCode();
		
		$this->assertNotEmpty($code);
	}
	
	public function testIsEmpty()
	{
		$this->assertFalse($this->map->isEmpty());
		
		$this->map->clear();
		
		$this->assertTrue($this->map->isEmpty());
	}
	
	public function testKeySet()
	{
		$keys = $this->map->keySet();
		
		$this->assertEquals(new ArraySet(['foo','by','bob']), $keys);
	}
	
	public function testPut()
	{
		$this->map->put('hey', 'hi');
		$this->assertEquals(4, $this->map->size());
	}
	
	public function testPutAll()
	{
		$this->map->putAll(new HashMap(['hey'=>'hi','hello'=>'world']));
		$this->assertEquals(5, $this->map->size());
	}
	
	public function testRemove()
	{
		$this->map->remove('by');
		
		$this->assertEquals(new HashMap([
			'foo'	=> 'bar',
			'bob'	=> 'frank'
		]), $this->map);
		
		$this->assertNull($this->map->remove('no'));
	}
	
	public function testSize()
	{
		$this->assertEquals(3, $this->map->size());
	}
	
	public function testValues()
	{
		$values = $this->map->values();
		
		$this->assertEquals(new ArrayList(['bar','baz','frank']), $values);
	}
}