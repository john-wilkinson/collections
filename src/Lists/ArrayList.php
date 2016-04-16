<?php
namespace Jmw\Collection\Lists;

use Jmw\Collection\CollectionInterface;
use Jmw\Collection\Exception\InvalidTypeException;
use Jmw\Collection\Exception\IndexOutOfBoundsException;
use Jmw\Collection\CollectionAbstract;

/**
 * This is the most generic collection type
 * It uses a simple PHP array as its underlying data
 * store, and PHP functions for most of the operations.
 * @author john
 *
 */
class ArrayList extends CollectionAbstract implements ListInterface
{
	/**
	 * Underlying data store
	 * @var array
	 */
	protected $array;
	
	/**
	 * Constructs an ArrayList
	 * Defaults with the given array
	 * @param array $array
	 */
	public function __construct($array = [])
	{
		if(!is_array($array))
		{
			throw new InvalidTypeException('array', gettype($array));
		}
		$this->array = array_values($array);
	}
	
	/**
	 * Appends the specified element to the end of this list.
	 * @param multitype $element
	 * @return void
	 */
	public function add($element)
	{
		$this->array[] = $element;
	}
	
	/**
	 * Inserts the specified element at the specified position in this list.
	 * @param int $index
	 * @param multitype $element
	 * @return void
	 */
	public function addAt($index, $element)
	{
		$this->checkInt($index);
		//element has to be wrapped in array sintax in case it is an object or an array or null
		array_splice($this->array, $index, 0, [$element]);
	}
	
	/**
	 * Removes all of the elements from this list.
	 * @return void
	 */
	public function clear()
	{
		$this->array = [];
	}
	
	/**
	 * Compares the specified object with this list for equality.
	 * @param multitype $object
	 * @return boolean
	 */
	public function equals($object)
	{
		if($object instanceof ListInterface && $object->size() === $this->size())
		{
			foreach ($object->toArray() as $index=>$element)
			{
				if($element !== $this->array[$index])
				{
					return false;
				}
			}
			return true;
		}
		
		return false;
	}
	
	/**
	 * Returns the element at the specified position in this list.
	 * @param int $index
	 * @return multitype
	 */
	public function get($index)
	{
		$this->checkInt($index);
		if(!array_key_exists($index, $this->array))
		{
			throw new IndexOutOfBoundsException($index);
		}
		return $this->array[$index];
	}
	
	/**
	 * Returns the index of the first occurrence of the 
	 * specified element in this list, 
	 * or -1 if this list does not contain the element.
	 * @param multitype $element
	 * @return int
	 */
	public function indexOf($element)
	{
		$index = array_search($element, $this->array, true);
		
		$index = $index === false ? -1 : $index;
		
		return $index;
	}
	
	/**
	 * Returns an iterator over the elements in this list in proper sequence.
	 * @return IteratorInterface
	 */
	public function iterator()
	{
		return $this->listIterator();
	}
	
	/**
	 * Returns the index of the last occurrence of the 
	 * specified element in this list, 
	 * or -1 if this list does not contain the element.
	 * @param multitype $element
	 * @return int
	 */
	public function lastIndexOf($element)
	{		
		$index = array_search($element, array_reverse($this->array), true);
		
		if($index === false)
		{
			$index = -1;
		}
		else
		{
			$index = $this->size() - $index - 1;
		}

		return $index;
	}
	
	/**
	 * Returns a list iterator over the elements 
	 * in this list (in proper sequence).
	 * @return ListIterator
	 */
	public function listIterator()
	{
		return new ListIterator($this);
	}
	
	/**
	 * Returns a list iterator over the elements in this list (in proper sequence), 
	 * starting at the specified position in the list.
	 * @param int $index
	 * @return ListIterator
	 */
	public function listIteratorAt($index)
	{
		return new ListIterator($this, $index);
	}
	
	/**
	 * Removes the first occurrence of the specified element 
	 * from this list, if it is present 
	 * @param multitype $element
	 * @return boolean
	 * @throws IndexOutOfBoundsException
	 */
	public function remove($element)
	{
		$index = $this->indexOf($element);
		
		if($index === -1)
		{
			return false;
		}
		
		return $this->removeAt($index);
	}
	
	/**
	 * Removes from this list all of its elements that
	 * are contained in the specified collection
	 * @param CollectionInterface $collection
	 * @return void 
	 */
	public function removeAll(CollectionInterface $collection)
	{
		$this->array = array_values(array_diff($this->array, $collection->toArray()));
	}
	
	/**
	 * Removes the element at the specified 
	 * position in this list (optional operation).
	 * @param int $index
	 * @return boolean
	 * @throws IndexOutOfBoundsException
	 */
	public function removeAt($index)
	{
		$this->checkInt($index);
		if($index < 0 || $index > $this->size())
		{
			throw new IndexOutOfBoundsException($index);
		}
		else
		{
			unset($this->array[$index]);
			$this->array = array_values($this->array);
		}
		return true;
	}
	
	/**
	 * Removes from this list all of the elements whose index is between 
	 * from, inclusive, and to, exclusive.
	 * @param int $from
	 * @param int $to
	 * @return void
	 */
	public function removeRange($from, $to)
	{
		array_splice($this->array, $from, $to - $from);
	}

	/**
	 * Replaces the element at the specified position
	 * in this list with the specified element.
	 * @param int $index
	 * @param int $element
	 * @return void
	 * @throws IndexOutOfBoundsException
	 */
	public function set($index, $element)
	{
		if(array_key_exists($index, $this->array))
		{
			$this->array[$index] = $element;
		}
		else
		{
			throw new IndexOutOfBoundsException($index);
		}
	}
	
	/**
	 * Returns the number of elements in this list.
	 * @return int
	 */
	public function size()
	{
		return count($this->array);
	}
	
	/**
	 * Returns a view of the portion of this list between the 
	 * specified from, inclusive, and to, exclusive.
	 * @param int $from
	 * @param int $to
	 * @return ArrayList
	 */
	public function subList($from, $to)
	{
		$this->checkInt($from);
		$this->checkInt($to);
		return new ArrayList(array_slice($this->array, $from, $to - $from));
	}
	
	/**
	 * Returns an array containing all of the elements in this list
	 * in proper sequence (from first to last element).
	 * @return array
	 */
	public function toArray()
	{
		return $this->array;
	}
	
	/**
	 * Returns the hash code value for this collection.
	 * @return string
	 */
	public function hashCode()
	{
		return spl_object_hash($this);
	}
	
	/**
	 * Checks to see if a variable is an int.
	 * This is meant to help ensure that all indexes
	 * remain integers.
	 * @param int $var
	 * @throws InvalidTypeException
	 */
	protected function checkInt($var)
	{
		if(!is_int($var))
		{
			throw new InvalidTypeException('int', gettype($var));
		}
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value)
	{
		if($offset === null) {
			$this->add($value);
		} else {
			$this->addAt($offset, $value);
		}
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset)
	{
		$this->removeAt($offset);
	}
}