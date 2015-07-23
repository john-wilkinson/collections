<?php
namespace Jmw\Collection\Set;

/**
 * A Set that further provides a total ordering on its elements. 
 * The elements are ordered using their natural ordering, or by a 
 * Comparator typically provided at sorted set creation time.
 * The set's iterator will traverse the set in ascending element order. 
 * Several additional operations are provided to take advantage of the ordering. 
 * @author john
 *
 */
interface SortedSetInterface extends SetInterface
{
	/**
	 * Returns the comparator used to order the elements in this set, 
	 * or null if this set uses the natural ordering of its elements.
	 * @return Comparator
	 */
	public function comparator();
	
	/**
	 * Returns the first (lowest) element currently in this set.
	 * @return multitype
	 */
	public function first();
	
	/**
	 * Returns a view of the portion of this set whose elements are strictly less than toElement.
	 * @param multitype $to
	 * @return SortedSet
	 */
	public function headSet($to);
	
	/**
	 * Returns the last (highest) element currently in this set.
	 * @return multitype
	 */
	public function last();
	
	/**
	 * Returns a view of the portion of this set whose elements range 
	 * from fromElement, inclusive, to toElement, exclusive.
	 * @param multitype $from
	 * @param multitype $to
	 */
	public function subSet($from, $to);
	
	/**
	 * Returns a view of the portion of this set whose elements 
	 * are greater than or equal to fromElement.
	 * @param multitype $from
	 * @return SortedSet
	 */
	public function tailSet($from);
}