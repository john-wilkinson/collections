<?php
namespace Jmw\Collection\Lists;

use Jmw\Collection\IteratorInterface;
use Jmw\Collection\Exception\NoSuchElementException;
use Jmw\Collection\Exception\IllegalStateException;
/**
 * A ReverseListIterator starts at the end of a list and works its way to the beginning
 * @author john
 *
 */
class ReverseListIterator implements IteratorInterface
{

	/**
	 * 
	 * @var ListInterface
	 */
	protected $list;

	/**
	 * 
	 * @var int
	 */
	protected $index;
	
	/**
	 * 
	 * @var boolean
	 */
	protected $canRemove;

	/**
	 * Construct a ReverseListIterator
	 * @param ListInterface $list
	 */
	public function __construct(ListInterface $list)
	{
		$this->index = $list->size();
		$this->list = $list;
	}

	/**
	 * Returns true if this list iterator has more elements when traversing the list in the backward direction.
	 * @return boolean
	 */
	public function next()
	{
		if ($this->hasNext())
		{
			$this->canRemove = true;
			return $this->list->get(--$this->index);
		}
		else
		{
			throw new NoSuchElementException("Could not find element at index {$this->index}");
		}
	}

	/**
	 * Returns the next element in the list and advances the cursor position.
	 * @return multitype
	 * @throws NoSuchElementException
	 */
	public function hasNext()
	{
		return $this->index > 0;
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
			$this->list->removeAt($this->index);
			$this->canRemove = false;
		}
		else
		{
			throw new IllegalStateException("Cannot remove element unless next has been called");
		}
	}
}