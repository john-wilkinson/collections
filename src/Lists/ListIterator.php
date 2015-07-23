<?php
namespace Jmw\Collection\Lists;

use Jmw\Collection\IteratorInterface;
use Jmw\Collection\Exception\IllegalStateException;
use Jmw\Collection\Exception\NoSuchElementException;

/**
 * The ListIterator is used for iterating over lists
 * @author john
 *
 */
class ListIterator implements IteratorInterface
{
	/**
	 * The current iteration index
	 * @var int
	 */
	protected $index;
	
	/**
	 * The underlying ListInterface object
	 * @var ListInterface
	 */
	protected $list;
	
	/**
	 * canRemove determine whether or not we can remove an item.
	 * The list can't remove things until after next has been called
	 * @var boolean
	 */
	protected $canRemove;
	
	/**
	 * Constructs a new ListIterator at the specified start position
	 * @param ListInterface $list
	 * @param int $start
	 */
	public function __construct(ListInterface $list, $start = 0)
	{
		$this->index = $start - 1;
		
		$this->list = $list;
				
		$this->canRemove = false;
	}
	
	/**
	 * Returns true if this list iterator has more elements when traversing the list in the forward direction.
	 * @return boolean
	 */
	public function hasNext()
	{
		return $this->index+1 < $this->list->size();
	}
	
	/**
	 * Returns the next element in the list and advances the cursor position.
	 * @return multitype
	 * @throws NoSuchElementException
	 */
	public function next()
	{
		if($this->hasNext())
		{
			$this->canRemove = true;
			return $this->list->get(++$this->index);
		}
		else
		{
			throw new NoSuchElementException("Could not find element at index {$this->index}");
		}
	}
	
	/**
	 * Removes from the list the last element that was returned by next()
	 * @return void
	 * @throws IllegalStateException
	 */
	public function remove()
	{
		if($this->canRemove)
		{
			$this->list->removeAt($this->index--);
			$this->canRemove = false;
		}
		else
		{
			throw new IllegalStateException("Cannot remove element unless next has been called");
		}
	}
}