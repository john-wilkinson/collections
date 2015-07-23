<?php
namespace Jmw\Collection\Queue;

use Jmw\Collection\Exception\IllegalStateException;
use Jmw\Collection\CollectionInterface;
/**
 * A collection designed for holding elements prior to processing. 
 * Besides basic Collection operations, queues provide additional insertion,
 *  extraction, and inspection operations. Each of these methods exists in two forms: 
 *  one throws an exception if the operation fails, the other returns a special value 
 *  (either null or false, depending on the operation). The latter form of the insert 
 *  operation is designed specifically for use with capacity-restricted Queue implementations; 
 *  in most implementations, insert operations cannot fail.
 * @author john
 *
 */
interface QueueInterface extends CollectionInterface
{
	/**
	 * Inserts the specified element into this queue if it is possible to 
	 * do so immediately without violating capacity restrictions, returning 
	 * true upon success and throwing 
	 * an IllegalStateException if no space is currently available.
	 * @param multitype $element
	 * @return boolean
	 * @throws IllegalStateException
	 */
	public function add($element);
	
	/**
	 * Retrieves, but does not remove, the head of this queue.
	 * @return multitype
	 */
	public function element();
	
	/**
	 * Retrieves, but does not remove, the head of this queue, 
	 * or returns null if this queue is empty.
	 * @return multitype | NULL
	 */
	public function peek();
	
	/**
	 * Inserts the specified element into this queue if it is possible 
	 * to do so immediately without violating capacity restrictions.
	 * @param multitype $element
	 * @return true
	 */
	public function offer($element);
	
	/**
	 * Retrieves and removes the head of this queue, 
	 * or returns null if this queue is empty.
 	 * @return multitype | NULL
	 */
	public function poll();
	
	/**
	 * Retrieves and removes the head of this queue.
	 * @return multitype
	 */
	public function removeHead();
}