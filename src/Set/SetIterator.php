<?php
namespace Jmw\Collection\Set;

use Jmw\Collection\IteratorInterface;
use Jmw\Collection\Exception\NoSuchElementException;
use Jmw\Collection\Exception\IllegalStateException;

/**
 * An iterator on a set. It uses an array to keep track
 * of the current location of iteration. Any modification to
 * the set during iteration except by using the iterator's 
 * remove method will put the iterator into an
 * undefined state.
 * @author john
 *
 */
class SetIterator implements IteratorInterface
{
	/**
	 * @var array
	 */
	protected $array;
	
	/**
	 * @var SetInterface
	 */
	protected $set;
	
	/**
	 * @var int
	 */
	protected $index;
	
	/**
	 * @var boolean
	 */
	protected $canRemove;
	
	/**
	 * Constructs a new SetIterator
	 * @param SetInterface $set
	 */
	public function __construct(SetInterface $set)
	{
		$this->array = $set->toArray();
		$this->index = -1;
		$this->set = $set;
		$this->canRemove = false;
	}
	
	/**
	 * Returns the next element in the iteration.
	 * @return multitype
	 */
	public function next()
	{
		if($this->hasNext())
		{
			$this->canRemove = true;
			return $this->array[++$this->index];
		}
		else
		{
			throw new NoSuchElementException();
		}
	}

	/**
	 * Returns true if the iteration has more elements. (In other words, returns
	 * true if next() would return an element rather than throwing an exception.)
	 * @return boolean
	 */
	public function hasNext()
	{
		return $this->index + 1 < $this->set->size();
	}
	
	/**
	 * Removes from the underlying collection the last
	 * element returned by this iterator (optional operation).
	 * This method can be called only once per call to next().
	 * The behavior of an iterator is unspecified if the underlying
	 * collection is modified while the iteration is in progress in any
	 * way other than by calling this method.
	 * @return boolean
	 */
	public function remove()
	{
		if($this->canRemove)
		{
			$removed = $this->set->remove($this->array[$this->index--]);
			$this->array = $this->set->toArray();
			$this->canRemove = false;
		}
		else
		{
			throw new IllegalStateException();
		}
	}
}