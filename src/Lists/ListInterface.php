<?php
/** This is incredibly stupid, but list is a php keyword, so we can't use it in the namespace.
 * Instead, we have to make it plural. Lists. Yuck.
 * @author john
 *
 */
namespace Jmw\Collection\Lists;

use Jmw\Collection\CollectionInterface;
interface ListInterface extends CollectionInterface
{
	/**
	 * Inserts the specified element at the specified position in this list (optional operation).
	 * @param int $index
	 * @param multitype $element
	 */
	public function addAt($index, $element);
	
	/**
	 * Returns the element at the specified position in this list.
	 * @param int $index
	 */
	public function get($index);
	
	/**
	 * Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
	 * @param multitype $element
	 */
	public function indexOf($element);
	
	/**
	 * Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
	 * @param multitype $element
	 */
	public function lastIndexOf($element);
	
	/**
	 * Returns a list iterator over the elements in this list (in proper sequence)
	 */
	public function listIterator();
	
	/**
	 * Returns a list iterator over the elements in this list (in proper sequence), starting at the specified position in the list.
	 * @param int $index
	 */
	public function listIteratorAt($index);
	
	/**
	 * Removes the element at the specified position in this list (optional operation).
	 * @param int $index
	 */
	public function removeAt($index);
	
	/**
	 * Replaces the element at the specified position in this list with the specified element (optional operation).
	 * @param int $index
	 * @param multitype $element
	 */
	public function set($index, $element);
	
	/**
	 * Returns a view of the portion of this list between the specified fromIndex, inclusive, and toIndex, exclusive.
	 * @param int $from
	 * @param int $to
	 */
	public function subList($from, $to);
}