<?php

namespace Jmw\Collection;

/**
 * Defines the methods needed for something to be an iterator
 * @author john
 *
 */
interface IteratorInterface
{
	/**
	 * Returns the next element in the iteration.
	 * @return multitype
	 */
	public function next();
	
	/**
	 * Returns true if the iteration has more elements. (In other words, returns 
	 * true if next() would return an element rather than throwing an exception.)
	 * @return boolean
	 */
	public function hasNext();
	
	/**
	 * Removes from the underlying collection the last 
	 * element returned by this iterator (optional operation). 
	 * This method can be called only once per call to next(). 
	 * The behavior of an iterator is unspecified if the underlying 
	 * collection is modified while the iteration is in progress in any 
	 * way other than by calling this method.
	 * @return boolean
	 */
	public function remove();
}