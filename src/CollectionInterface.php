<?php

namespace Jmw\Collection;

/**
 * The root interface in the collection hierarchy. 
 * A collection represents a group of objects, known as its elements. 
 * Some collections allow duplicate elements and others do not. 
 * Some are ordered and others unordered. The Collections package does not provide any direct implementations of this interface: 
 * it provides implementations of more specific subinterfaces like Set and List. 
 * This interface is typically used to pass collections around and manipulate them where maximum generality is desired.
 * @author john
 *
 */
interface CollectionInterface extends IterableInterface
{
	/**
	 * Ensures that this collection contains the specified element (optional operation).
	 * @param multitype $element
	 * @return boolean
	 */
	public function add($element);
	
	/**
	 * Adds all of the elements in the specified collection to this collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean
	 */
	public function addAll(CollectionInterface $collection);
	
	/**
	 * Removes all of the elements from this collection (optional operation).
	 * @return void
	 */
	public function clear();
	
	/**
	 * Returns true if this collection contains the specified element.
	 * @return boolean
	 */
	public function contains($element);
	
	/**
	 * Returns true if this collection contains all of the elements in the specified collection.
	 * @param Collection $collection
	 * @return boolean
	 */
	public function containsAll(CollectionInterface $collection);
	
	/**
	 * Compares the specified object with this collection for equality.
	 * @param unknown $object
	 * @return boolean
	 */
	public function equals($object);
	
	/**
	 * Returns the hash code value for this collection.
	 * @return string
	 */
	public function hashCode();
	
	/**
	 * Returns true if this collection contains no elements.
	 * @return boolean
	 */
	public function isEmpty();
	
	/**
	 * Returns an iterator over the elements in this collection.
	 * @return IteratorInterface
	 */
	public function iterator();
	
	/**
	 * Removes a single instance of the specified element from this collection, if it is present (optional operation).
	 * @param multitype $element
	 * @return boolean
	 */
	public function remove($element);
	
	/**
	 * Removes all of this collection's elements that are also contained in the specified collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean
	 */
	public function removeAll(CollectionInterface $collection);
	
	/**
	 * Retains only the elements in this collection that are contained in the specified collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean
	 */
	public function retainAll(CollectionInterface $collection);
	
	/**
	 * Returns the number of elements in this collection.
	 * @return int
	 */
	public function size();
	
	/**
	 * Returns an array containing all of the elements in this collection.
	 * @return array
	 */
	public function toArray();
	
	/**
	 * Returns a json string representing all the elements in this collection
	 * @return string
	 */
	public function toJson();
}