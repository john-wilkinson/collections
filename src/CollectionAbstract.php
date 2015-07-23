<?php
namespace Jmw\Collection;

/**
 * This class provides a skeletal implementation of the Collection interface, 
 * to minimize the effort required to implement this interface.
 * 
 * To implement an unmodifiable collection, the programmer needs only to extend this
 * class and provide implementations for the iterator and size methods, and use the ImmutableCollectionTrait trait
 * (The iterator returned by the iterator method must implement hasNext and next.)
 * @author john
 *
 */
abstract class CollectionAbstract implements CollectionInterface
{	
	/**
	 * Adds all of the elements in the specified collection to this collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean $changed
	*/
	public function addAll(CollectionInterface $collection)
	{
		$iterator = $collection->iterator();
		$changed = false;
		
		while($iterator->hasNext())
		{
			$changed = true;
			$this->add($iterator->next());
		}
		
		return $changed;		
	}
	
	/**
	 * Returns true if this collection contains the specified element.
	 * @return boolean
	*/
	public function contains($element)
	{
		$iterator = $this->iterator();
		
		while($iterator->hasNext())
		{
			if($element === $iterator->next())
			{
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Returns true if this collection contains all of the elements in the specified collection.
	 * @param Collection $collection
	 * @return boolean
	*/
	public function containsAll(CollectionInterface $collection)
	{
		$iterator = $collection->iterator();
		
		while($iterator->hasNext())
		{
			if(!$this->contains($iterator->next()))
			{
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Compares the specified object with this collection for equality.
	 * @param unknown $object
	 * @return boolean
	*/
	public function equals($object)
	{
		if(!$object instanceof CollectionInterface)
		{
			return false;
		}
		return $this->hashCode() === $object->hashCode();
	}
	
	/**
	 * Returns true if this collection contains no elements.
	 * @return boolean
	*/
	public function isEmpty()
	{
		return $this->size() === 0;
	}
	
	/**
	 * Retains only the elements in this collection that are contained in the specified collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean
	*/
	public function retainAll(CollectionInterface $collection)
	{
		$iterator = $this->iterator();
		$changed = false;
		
		while($iterator->hasNext())
		{
			if(!$collection->contains($iterator->next()))
			{
				$iterator->remove();
				$changed = true;
			}
		}
		return $changed;
	}

	/**
	 * Returns a json string representing all the elements in this collection
	 * @return string
	 */
	public function toJson()
	{
		$json = json_encode($this->toArray());
		if($error = json_last_error())
		{
			throw new \Exception('Error encoding to json: ' . $error);
		}
		return $json;
	}
	
	/**
	 * Ensures that this collection contains the specified element (optional operation).
	 * @param multitype $element
	 * @return boolean
	 */
	public abstract function add($element);
	
	/**
	 * Removes all of the elements from this collection (optional operation).
	 * @return void
	 */
	public abstract function clear();

	/**
	 * Returns an iterator over the elements in this collection.
	 * @return IteratorInterface
	 */
	public abstract function iterator();
	
	/**
	 * Removes a single instance of the specified element from this collection, if it is present (optional operation).
	 * @param multitype $element
	 * @return boolean
	*/
	public abstract function remove($element);
	
	/**
	 * Removes all of this collection's elements that are also contained in the specified collection (optional operation).
	 * @param CollectionInterface $collection
	 * @return boolean
	*/
	public abstract function removeAll(CollectionInterface $collection);
	
	/**
	 * Returns the number of elements in this collection.
	 * @return int
	*/
	public abstract function size();
	
	/**
	 * Returns an array containing all of the elements in this collection.
	 * @return array
	*/
	public abstract function toArray();
	
	/**
	 * Returns the hash code value for this collection.
	 * @return string
	 */
	public abstract function hashCode();
}