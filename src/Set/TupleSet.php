<?php
namespace Jmw\Collection\Set;

use Jmw\Collection\Lists\Tuple;
use Jmw\Collection\Exception\InvalidTypeException;
use Jmw\Collection\Lists\ArrayList;
/**
 * A set of Tuple elements, which ensures that only Tuple elements
 * may be added to the set, and no Tuple element may be duplicated
 * @author john
 *
 */
class TupleSet extends SetAbstract
{
	protected $arrayList;
	
	/**
	 * Construct a TupleSet from an array
	 * Each key=>value pair will become a Tuple<key, value>
	 * @param unknown $array
	 */
	public function __construct($array)
	{
		$this->clear();
		foreach ($array as $value1=>$value2)
		{
			$this->add(new Tuple($value1, $value2));
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
		if($element instanceof Tuple)
		{
			if(!$this->contains($element))
			{
				$this->arrayList->add($element);
				$changed = true;
			}
		}
		else
		{
			throw new InvalidTypeException('Jmw\Collection\Lists\Tuple', gettype($element));
		}
		$changed;
	}
	
	/**
	 * Removes all of the elements from this collection (optional operation).
	*/
	public function clear()
	{
		$this->arrayList = new ArrayList();
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
	public function remove($tuple)
	{
		$iterator = $this->arrayList->iterator();
		
		while($iterator->hasNext())
		{
			$element = $iterator->next();
			if($element->equals($tuple))
			{
				$iterator->remove();
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Returns the number of elements in this collection.
	*/
	public function size()
	{
		return $this->arrayList->size();
	}
	
	/**
	 * Returns an array containing all of the elements in this collection.
	*/
	public function toArray()
	{
		return $this->arrayList->toArray();
	}
}