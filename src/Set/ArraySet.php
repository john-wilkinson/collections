<?php
namespace Jmw\Collection\Set;

use Jmw\Collection\Lists\Tuple;
use Jmw\Collection\Lists\ArrayList;
/**
 * An implementation of a Set using a php array
 * It is advisable to use a HashSet in most instances,
 * as it is significantly faster
 * @author john
 *
 */
class ArraySet extends SetAbstract
{
	/**
	 * @var array
	 */
	protected $array;
	
	/**
	 * @param array $array
	 */
	public function __construct($array)
	{
		$this->clear();
		foreach ($array as $element)
		{
			$this->add($element);
		}
	}
	
	/**
	 * Ensures that this collection contains the specified element (optional operation).
	 * @param multitype $element
	 * @return boolean
	 */
	public function add($element)
	{
		$changed = false;
		if(!$this->contains($element))
		{
			$this->array[] = $element;
			$changed = true;
		}
		return $changed;
	}
	
	/**
	 * Removes all of the elements from this collection (optional operation).
	 * @return void
	 */
	public function clear()
	{
		$this->array = [];
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
	 * @param boolean $changed
	 */
	public function remove($element)
	{
		$changed = false;
		foreach ($this->array as $key=>$value)
		{
			if($element === $value)
			{
				$changed = true;
				unset($this->array[$key]);
				$this->array = array_values($this->array);
			}
		}
		return $changed;
	}
	
	/**
	 * Returns the number of elements in this collection.
	 * @return int
	 */
	public function size()
	{
		return count($this->array);
	}
	
	/**
	 * Returns an array containing all of the elements in this collection.
	 * @return array
	 */
	public function toArray()
	{
		return $this->array;
	}
}