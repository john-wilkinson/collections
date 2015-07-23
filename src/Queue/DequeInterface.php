<?php
namespace Jmw\Collection\Queue;

use Jmw\Collection\Exception\IllegalStateException;
/**
 * A linear collection that supports element insertion and removal at both ends. 
 * The name deque is short for "double ended queue" and is usually pronounced "deck". 
 * Most Deque implementations place no fixed limits on the number of elements they may contain, 
 * but this interface supports capacity-restricted deques as well as those with no fixed size limit.
 * @author john
 *
 */
interface DequeInterface extends QueueInterface
{
	/**
	 * Inserts the specified element at the front of this deque if it is possible 
	 * to do so immediately without violating capacity restrictions.
	 * @param multitype $element
	 * @return void
	 */
	public function addFirst($element);
	
	/**
	 * Inserts the specified element at the end of this deque if it is possible to 
	 * do so immediately without violating capacity restrictions.
	 * @param multitype $element
	 * @return void
	 */
	public function addLast($element);
	
	/**
	 * Returns an iterator over the elements in this deque in reverse sequential order.
	 * @return IteratorInterface
	 */
	public function descendingIterator();
	
	/**
	 * Retrieves, but does not remove, the first element of this deque.
	 * This method differs from peekFirst only in that it throws an exception if this deque is empty.
	 * @return multitype $element
	 * @throws NoSuchElementException
	 */
	public function getFirst();
	
	/**
	 * Retrieves, but does not remove, the last element of this deque.
	 * This method differs from peekLast only in that it throws an exception if this deque is empty.
	 * @return multitype $element
 	 * @throws NoSuchElementException
	*/
	public function getLast();
	
	/**
	 * Inserts the specified element at the front of this deque 
	 * unless it would violate capacity restrictions.
	 * @param multitype $element
	 * @return boolean
	 */
	public function offerFirst($element);
	
	/**
	 * Inserts the specified element at the end of this deque 
	 * unless it would violate capacity restrictions.
	 * @param multitype $element
	 * @return boolean
	 */
	public function offerLast($element);
	
	/**
	 * Retrieves, but does not remove, the first element of this deque, 
	 * or returns null if this deque is empty.
	 * @return multitype | null
	 */
	public function peekFirst();
	
	/**
	 * Retrieves, but does not remove, the last element of this deque, 
	 * or returns null if this deque is empty.
	 * @return multitype | null
	 */
	public function peekLast();
	
	/**
	 * Retrieves and removes the first element of this deque, 
	 * or returns null if this deque is empty.
	 * 
	 * @return multitype | null
	 */
	public function pollFirst();
	
	/**
	 * Retrieves and removes the last element of this deque, 
	 * or returns null if this deque is empty.
	 * 
	 * @return multitype | null
	 */
	public function pollLast();
	
	/**
	 * Pops an element from the stack represented by this deque.
	 * @return multitype
	 */
	public function pop();
	
	/**
	 * Pushes an element onto the stack represented by this deque 
	 * (in other words, at the head of this deque) if it is possible 
	 * to do so immediately without violating capacity restrictions, 
	 * returning true upon success and throwing an IllegalStateException 
	 * if no space is currently available.
	 * @param unknown $element
	 * @throws IllegalStateException
	 * @return void
	 */
	public function push($element);
	
	/**
	 * Retrieves and removes the head of the queue represented 
	 * by this deque (in other words, the first element of this deque).
	 * @return boolean
	 */
	public function removeHead();
	
	/**
	 * Retrieves and removes the first element of this deque.
	 * @return multitype
	 */
	public function removeFirst();
	
	/**
	 * Removes the first occurrence of the specified element from this deque.
	 * @param multitype $element
	 * @return boolean
	 */
	public function removeFirstOccurrence($element);
	
	/**
	 * Retrieves and removes the last element of this deque.
	 * @return multitype $element
	 * @throws NoSuchElementException
	 */
	public function removeLast();
	
	/**
	 * Removes the last occurrence of the specified element from this deque.
	 * @param multitype $element
	 * @return boolean
	 */
	public function removeLastOccurrence($element);
}