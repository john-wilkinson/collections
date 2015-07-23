<?php
namespace Jmw\Collection\Map;

use Jmw\Collection\Set\SetAbstract;
use Jmw\Collection\Lists\ArrayList;
use Jmw\Collection\Set\TupleSet;
use Jmw\Collection\Set\ArraySet;
/**
 * Hash table based implementation of the Map interface. 
 * This implementation provides all of the optional map operations, 
 * and permits null values and the null key.
 * @author john
 *
 */
class HashMap implements MapInterface
{	
	/**
	 * @var array
	 */
	protected $array;
	
	/**
	 * Constructs a HashTable. A standard php array may be passed in as starting data.
	 * HashMap only uses a copy of the passed in array, so changes made by the HashMap
	 * will NOT be reflected in the original array, and vice-versa
	 * @param array $array
	 */
	public function __construct($array = null)
	{
		$this->clear();
		
		if($array !== null)
		{
			$this->array = $array;
		}
	}
	
	/**
	 * Removes all of the mappings from this map.
	 */
	public function clear()
	{
		$this->array = [];
	}
	
	/**
	 * Returns true if this map contains a mapping for the specified key.
	 * @param multitype $key
	 * @return boolean
	*/
	public function containsKey($key)
	{
		return array_key_exists($key, $this->array);
	}
	
	/**
	 * Returns true if this map maps one or more keys to the specified value.
	 * @param unknown $value
	 * @return boolean
	*/
	public function containsValue($value)
	{
		return in_array($value, $this->array);
	}
	
	/**
	 * Returns a Set view of the mappings contained in this map.
	 * @return SetInterface
	*/
	public function entrySet()
	{
		return new TupleSet($this->array);
	}
	
	/**
	 * Compares the specified object with this map for equality.
	 * @return boolean
	*/
	public function equals($object)
	{
		return $this->hashCode() === spl_object_hash($object);
	}
	
	/**
	 * Returns the value to which the specified key is mapped, or null if this map contains no mapping for the key.
	 * @param multitype $key
	 * @return multitype
	*/
	public function get($key)
	{
		if(!array_key_exists($key, $this->array))
		{
			return null;
		}
		return $this->array[$key];
	}
	
	/**
	 * Returns the hash code value for this map.
	 * @return string
	*/
	public function hashCode()
	{
		return spl_object_hash($this);
	}
	
	/**
	 * Returns true if this map contains no key-value mappings.
	 * @return boolean
	*/
	public function isEmpty()
	{
		return empty($this->array);
	}
	
	/**
	 * Returns a Set view of the keys contained in this map.
	 * @return SetInterface
	*/
	public function keySet()
	{
		return new ArraySet(array_keys($this->array));
	}
	
	/**
	 * Associates the specified value with the specified key in this map (optional operation).
	 * @param multitype $key
	 * @param multitype $value
	 * @return multitype
	*/
	public function put($key, $value)
	{
		$this->array[$key] = $value;
	}
	
	/**
	 * Copies all of the mappings from the specified map to this map (optional operation).
	 * @param MapInterface $map
	 * @return void
	*/
	public function putAll(MapInterface $map)
	{
		foreach($map->array as $key=>$value)
		{
			$this->put($key, $value);
		}
	}
	
	/**
	 * Removes the mapping for a key from this map if it is present
	 * It returns the previous value associated with key,
	 * or null if there was no mapping for key. 
	 * (A null return can also indicate that the map previously associated null with key.)
	 * @param unknown $key
	 * @return multitype $value | null
	*/
	public function remove($key)
	{
		if($this->containsKey($key))
		{
			$value = $this->array[$key];
			unset($this->array[$key]);
		}
		else
		{
			$value = null;
		}
		
		return $value;
	}
	
	/**
	 * Returns the number of key-value mappings in this map.
	 * @return int
	*/
	public function size()
	{
		return count($this->array);
	}
	
	/**
	 * Returns a Collection view of the values contained in this map.
	 * @return CollectionInterface
	*/
	public function values()
	{
		return new ArrayList(array_values($this->array));
	}
}