<?php
namespace Jmw\Collection\Lists;

use Jmw\Collection\CollectionAbstract;
use Jmw\Collection\Exception\UnsupportedOperationException;
use Jmw\Collection\CollectionInterface;
use Jmw\Collection\ImmutableInterface;

/**
 * Tuples are useful structures for passing around simple, immutable data sets.
 * @author john
 *
 */
class Tuple extends CollectionAbstract implements ListInterface, ImmutableInterface
{
	use ImmutableListTrait;
	
	/**
	 * An internal, immutable array containing values
	 * @var array
	 */
	private $values;
	
	public function __construct()
	{
		$this->values = func_get_args();
	}
	
	public function hashCode()
	{
		$iterator = $this->iterator();
		
		$code = 0;
		while($iterator->hasNext())
		{
			$element = $iterator->next();
			$hash = hash('sha256', serialize($element));
			$value = base_convert($hash, 16, 10);
			$code += $value;
		}
		
		return $code;
	}
	
	/********************************************************
	 ** Collection methods
	********************************************************/

	/**
	 * Returns an iterator over the elements in this collection.
	 * @return IteratorInterface
	*/
	public function iterator()
	{
		return new ListIterator($this);
	}
	
	/**
	 * Returns the number of elements in this collection.
	*/
	public function size()
	{
		return count($this->values);
	}
	
	/**
	 * Returns an array containing all of the elements in this collection.
	*/
	public function toArray()
	{
		return $this->values;
	}
	
	/********************************************************
	 ** List methods
	 ********************************************************/
	
	/**
	 * Returns the element at the specified position in this list.
	 * @param int $index
	*/
	public function get($index)
	{
		return $this->values[$index];
	}
	
	/**
	 * Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
	 * @param multitype $element
	*/
	public function indexOf($element)
	{
		$index = array_search($element, $this->values, true);
		
		$index = $index ? $index : -1;
		
		return $index;
	}
	
	/**
	 * Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
	 * @param multitype $element
	*/
	public function lastIndexOf($element)
	{
		$index = array_search($element, array_reverse($this->values), true);
		
		$index = $index ? $index : -1;
		
		return $index;
	}
	
	/**
	 * Returns a list iterator over the elements in this list (in proper sequence)
	*/
	public function listIterator()
	{
		return $this->iterator();
	}
	
	/**
	 * Returns a list iterator over the elements in this list (in proper sequence), starting at the specified position in the list.
	 * @param int $index
	*/
	public function listIteratorAt($index)
	{
		return new ListIterator($this, $index);
	}

	
	/**
	 * Returns a view of the portion of this list between the specified fromIndex, inclusive, and toIndex, exclusive.
	 * @param int $from
	 * @param int $to
	 * @return ArrayList
	*/
	public function subList($from, $to)
	{
		return new ArrayList(array_slice($this->values, $from, $to - $from));
	}
	
	/*********************************************
	 ** Array Access Methods
	 *********************************************/
	
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset)
	{
		if(!is_int($offset) || $offset >= $this->size() || $offset < 0) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset)
	{
		return $this->get($offset);
	}
}