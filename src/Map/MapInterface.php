<?php
namespace Jmw\Collection\Map;

/**
 * An object that maps keys to values. 
 * A map cannot contain duplicate keys; each key can map to at most one value.
 * @author john
 *
 */
interface MapInterface
{
	/**
	 * Removes all of the mappings from this map.
	 */
	public function clear();
	
	/**
	 * Returns true if this map contains a mapping for the specified key.
	 * @param multitype $key
	 * @return boolean
	 */
	public function containsKey($key);
	
	/**
	 * Returns true if this map maps one or more keys to the specified value.
	 * @param unknown $value
	 * @return boolean
	 */
	public function containsValue($value);
	
	/**
	 * Returns a Set view of the mappings contained in this map.
	 * @return SetInterface
	 */
	public function entrySet();
	
	/**
	 * Compares the specified object with this map for equality.
	 * @return boolean
	 */
	public function equals($object);
	
	/**
	 * Returns the value to which the specified key is mapped, or null if this map contains no mapping for the key.
	 * @param multitype $key
	 * @return multitype
	 */
	public function get($key);
	
	/**
	 * Returns the hash code value for this map.
	 * @return string
	 */
	public function hashCode();
	
	/**
	 * Returns true if this map contains no key-value mappings.
	 * @return boolean
	 */
	public function isEmpty();
	
	/**
	 * Returns a Set view of the keys contained in this map.
	 * @return SetInterface
	 */
	public function keySet();
	
	/**
	 * Associates the specified value with the specified key in this map (optional operation).
	 * @param multitype $key
	 * @param multitype $value
	 * @return multitype
	 */
	public function put($key, $value);
	
	/**
	 * Copies all of the mappings from the specified map to this map (optional operation).
	 * @param MapInterface $map
	 * @return void
	 */
	public function putAll(MapInterface $map);
	
	/**
	 * Removes the mapping for a key from this map if it is present
	 * @param unknown $key
	 * @return multitype $value
	 */
	public function remove($key);
	
	/**
	 * Returns the number of key-value mappings in this map.
	 * @return int
	 */
	public function size();
	
	/**
	 * Returns a Collection view of the values contained in this map.
	 * @return CollectionInterface
	 */
	public function values();
}