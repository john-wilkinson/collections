<?php
namespace Jmw\Collection\Set;

use Jmw\Collection\Map\HashMap;
use Jmw\Collection\Lists\ArrayList;

/**
 * This class implements the Set interface, backed by a hash table (actually a HashMap instance). 
 * It makes no guarantees as to the iteration order of the set; 
 * in particular, it does not guarantee that the order will remain constant over time. 
 * This class permits the null element.
 * @author john
 *
 */
class HashSet extends SetAbstract
{
	/**
	 * @var HashMap
	 */
	protected $map;
	
	/**
	 * Constructs a new HashSet instance
	 * It can be passed default values, and will implicitely remove
	 * any duplicates
	 * @param array
	 */
	public function __construct($array = [])
	{
		$this->clear();
		
		$this->addAll(new ArrayList($array));
	}
	
	/**
	 * Adds the specified element to this set if it is not already present. 
	 * More formally, adds the specified element e to this set if this set 
	 * contains no element e2 such that (e==null ? e2==null : e.equals(e2)). 
	 * If this set already contains the element, the call leaves the set unchanged 
	 * and returns false.
	 * @param multitype $element
	 * @return boolean
	 */
	public function add($element)
	{
		$changed = false;
		if(!$this->contains($element))
		{
			$key = $this->getHash($element);
			$this->map->put($key, $element);
			$changed = true;
		}
		
		return $changed;
	}
	
	/**
	 * Removes all of the elements from this set. 
	 * The set will be empty after this call returns.
	 * @return void
	*/
	public function clear()
	{
		$this->map = new HashMap();
	}

	/**
	 * Returns true if this collection contains the specified element.
	 * @return boolean;
	 */
	public function contains($element)
	{
		return $this->map->containsKey($this->getHash($element));
	}
	
	/**
	 * Returns an iterator over the elements in this collection.
	 * @return IteratorInterface
	*/
	public function iterator()
	{
		return new SetIterator($this);
	}
	
	/**
	 * Removes a single instance of the specified element from this collection, if it is present (optional operation).
	 * @param multitype $element
	 * @return boolean
	*/
	public function remove($element)
	{
		$changed = false;
		if($this->contains($element))
		{
			$this->map->remove($this->getHash($element));
			$changed = true;
		}
		return $changed;
	}
	
	/**
	 * Returns the number of elements in this collection.
	 * @return int
	*/
	public function size()
	{
		return $this->map->size();
	}
	
	/**
	 * Returns an array containing all of the elements in this collection.
	 * @return array
	*/
	public function toArray()
	{
		return $this->map->values()->toArray();
	}
	
	/**
	 * Return a general hashing function for elements
	 * @param unknown $element
	 * @return string
	 */
	protected function getHash($element)
	{
		return hash('sha256', serialize($element));
	}
}