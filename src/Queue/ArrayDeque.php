<?php
namespace Jmw\Collection\Queue;

use Jmw\Collection\CollectionInterface;
use Jmw\Collection\Exception\NoSuchElementException;
use Jmw\Collection\Lists\ArrayList;
use Jmw\Collection\Lists\ReverseListIterator;

/**
 * Resizable-array implementation of the Deque interface. 
 * Array deques have no capacity restrictions; they grow as necessary to support usage. 
 * @author john
 *
 */
class ArrayDeque extends ArrayList implements DequeInterface
{
	/**
	 * Inserts the specified element at the front of this deque if it is possible
	 * to do so immediately without violating capacity restrictions.
	 * 
	 * @param multitype $element        	
	 */
	public function addFirst($element)
	{
		$this->addAt(0, $element);
	}

	/**
	 * Inserts the specified element at the end of this deque if it is possible to
	 * do so immediately without violating capacity restrictions.
	 * 
	 * @param multitype $element        	
	 */
	public function addLast($element)
	{
		$this->addAt($this->size(), $element);
	}

	/**
	 * Returns an iterator over the elements in this deque in reverse sequential order.
	 * 
	 * @return IteratorInterface
	 */
	public function descendingIterator()
	{
		return new ReverseListIterator($this);
	}

	/**
	 * Retrieves, but does not remove, the head of this queue.
	 * 
	 * @return multitype
	 */
	public function element()
	{
		if ($this->isEmpty())
		{
			throw new NoSuchElementException("No head element, list is empty");
		}
		return $this->get(0);
	}
	

	/**
	 * Retrieves, but does not remove, the first element of this deque.
	 * This method differs from peekFirst only in that it throws an exception if this deque is empty.
	 * @return multitype $element
	 * @throws NoSuchElementException
	 */
	public function getFirst()
	{
		return $this->element();
	}
	
	/**
	 * Retrieves, but does not remove, the last element of this deque.
	 * This method differs from peekLast only in that it throws an exception if this deque is empty.
	 * @return multitype $element
 	 * @throws NoSuchElementException
	*/
	public function getLast()
	{
		if($this->isEmpty())
		{
			throw new NoSuchElementException("No tail element, list is empty");
		}
		return $this->get($this->size() - 1);
	}
	

	/**
	 * Inserts the specified element into this queue if it is possible
	 * to do so immediately without violating capacity restrictions.	 
	 * @param multitype $element
	 * @return true
	 */
	public function offer($element)
	{
		return $this->offerLast($element);
	}

	/**
	 * Inserts the specified element at the front of this deque
	 * unless it would violate capacity restrictions.
	 * 
	 * @param multitype $element        	
	 * @return boolean
	 */
	public function offerFirst($element)
	{
		$this->addFirst($element);
		return true;
	}

	/**
	 * Inserts the specified element at the end of this deque
	 * unless it would violate capacity restrictions.
	 * 
	 * @param multitype $element        	
	 * @return boolean
	 */
	public function offerLast($element)
	{
		$this->add($element);
		return true;
	}

	/**
	 * Retrieves, but does not remove, the head of this queue,
	 * or returns null if this queue is empty.
	 * 
	 * @return multitype | null
	 */
	public function peek()
	{
		return $this->peekFirst();
	}

	/**
	 * Retrieves, but does not remove, the first element of this deque,
	 * or returns null if this deque is empty.
	 * 
	 * @return multitype | null
	 */
	public function peekFirst()
	{
		if ($this->isEmpty())
		{
			return null;
		}
		return $this->get(0);
	}

	/**
	 * Retrieves, but does not remove, the last element of this deque,
	 * or returns null if this deque is empty.
	 * 
	 * @return multitype | null
	 */
	public function peekLast()
	{
		if($this->isEmpty())
		{
			return null;
		}

		return $this->get($this->size() - 1);
	}
	
	/**
	 * Retrieves and removes the head of this queue,
	 * or returns null if this queue is empty.
	 * @return multitype | NULL
	 */
	public function poll()
	{
		return $this->pollFirst();
	}
	
	/**
	 * Retrieves and removes the first element of this deque,
	 * or returns null if this deque is empty.
	 *
	 * @return multitype | null
	 */
	public function pollFirst()
	{
		if ($this->isEmpty())
		{
			return null;
		}
		return $this->removeFirst();
	}

	/**
	 * Retrieves and removes the last element of this deque,
	 * or returns null if this deque is empty.
	 *
	 * @return multitype | null
	 */
	public function pollLast()
	{
		if ($this->isEmpty())
		{
			return null;
		}
		$index = $this->size() - 1;
		$element = $this->get($index);
		$this->removeAt($index);
		
		return $element;
	}

	/**
	 * Pops an element from the stack represented by this deque.
	 * 
	 * @return multitype
	 */
	public function pop()
	{
		return $this->removeFirst();
	}

	/**
	 * Pushes an element onto the stack represented by this deque
	 * (in other words, at the head of this deque) if it is possible
	 * to do so immediately without violating capacity restrictions,
	 * returning true upon success and throwing an IllegalStateException
	 * if no space is currently available.
	 * 
	 * @param unknown $element        	
	 * @throws IllegalStateException
	 */
	public function push($element)
	{
		$this->addFirst($element);
	}

	/**
	 * Retrieves and removes the head of the queue represented
	 * by this deque (in other words, the first element of this deque).
	 * 
	 * @return multitype
	 * @throws NoSuchElementException
	 */
	public function removeHead()
	{
		if ($this->isEmpty())
		{
			throw new NoSuchElementException();
		}
		$element = $this->get(0);
		
		$this->removeAt(0);
		
		return $element;
	}

	/**
	 * Retrieves and removes the first element of this deque.
	 * 
	 * @return multitype $element
	 * @throws NoSuchElementException
	 */
	public function removeFirst()
	{
		return $this->removeHead();		
	}

	/**
	 * Removes the first occurrence of the specified element from this deque.
	 * 
	 * @param multitype $element
	 * @return boolean      	
	 */
	public function removeFirstOccurrence($element)
	{
		return $this->remove($element);
	}

	/**
	 * Retrieves and removes the last element of this deque.
	 * @return multitype $element
	 * @throws NoSuchElementException
	 */
	public function removeLast()
	{
		if($this->isEmpty())
		{
			throw new NoSuchElementException("List is empty, cannot remove tail element");
		}
		$index = $this->size() - 1;
		$element = $this->get($index);
		$this->removeAt($index);
		
		return $element;
	}

	/**
	 * Removes the last occurrence of the specified element from this deque.
	 * 
	 * @param multitype $element
	 * @return boolean	
	 */
	public function removeLastOccurrence($element)
	{
		return $this->removeAt($this->lastIndexOf($element));
	}
}