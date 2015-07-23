<?php
namespace Jmw\Collection;

use Jmw\Collection\Exception\UnsupportedOperationException;
/**
 * This trait is ensures immutability by throwing an exception
 * on all mutable CollectionInterface methods
 * @author john
 *
 */
trait ImmutableCollectionTrait
{
	/**
	 * add is not supported by immutable objects.
	 * @param multitype $element
	 * @throws UnsupportedOperationException
	 */
	public function add($element)
	{
		throw new UnsupportedOperationException('add');
	}
	
	/**
	 * addAll is not supported by immutable objects.
	 * @param CollectionInterface $collection
 	 * @throws UnsupportedOperationException
	 */
	public function addAll(CollectionInterface $collection)
	{
		throw new UnsupportedOperationException('addAll');
	}
	
	/**
	 * clear is not supported by immutable objects.
 	 * @throws UnsupportedOperationException
	 */
	public function clear()
	{
		throw new UnsupportedOperationException('clear');
	}

	/**
	 * Remove is not supported by immutable objects.
	 * @param multitype $element
 	 * @throws UnsupportedOperationException
	 */
	public function remove($element)
	{
		throw new UnsupportedOperationException('remove');
	}
	
	/**
	 * removeAll is not supported by immutable objects.
	 * @param CollectionInterface $collection
	 */
	public function removeAll(CollectionInterface $collection)
	{
		throw new UnsupportedOperationException('removeAll');
	}

	/**
	 * retainAll is not supported by immutable objects.
	 * @param CollectionInterface $collection
 	 * @throws UnsupportedOperationException
	 */
	public function retainAll(CollectionInterface $collection)
	{
		throw new UnsupportedOperationException('retainAll');
	}
	
}