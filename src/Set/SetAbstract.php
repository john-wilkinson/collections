<?php
namespace Jmw\Collection\Set;

use Jmw\Collection\CollectionAbstract;
use Jmw\Collection\CollectionInterface;

/**
 * This class provides a skeletal implementation of the Set interface 
 * to minimize the effort required to implement this interface.
 * 
 * The process of implementing a set by extending this class is identical 
 * to that of implementing a Collection by extending AbstractCollection, except 
 * that all of the methods and constructors in subclasses of this class must 
 * obey the additional constraints imposed by the Set interface (for instance, 
 * the add method must not permit addition of multiple instances of an object to a set).
 * 
 * Note that this class does not override any of the implementations from the 
 * AbstractCollection class except hashCode. 
 * It merely adds implementations for hashCode and removeAll.
 * @author john
 *
 */
abstract class SetAbstract extends CollectionAbstract implements SetInterface
{
	/**
	 * Removes all of this collection's elements that are also contained in the specified collection (optional operation).
	 * @param CollectionInterface $collection
	 */
	public function removeAll(CollectionInterface $collection)
	{
		$changed = false;
		if($this->size() > $collection->size())
		{
			$iterator = $collection->iterator();
			
			while($iterator->hasNext())
			{
				$element = $iterator->next();
				if($this->contains($element))
				{
					$this->remove($element);
					$changed = true;
				}
			}
		}
		else
		{
			$iterator = $this->iterator();
			
			while($iterator->hasNext())
			{
				$element = $iterator->next();
				if($collection->contains($element))
				{
					$iterator->remove();
					$changed = true;
				}
			}
		}
		
		return $changed;
	}
	
	/**
	 * Returns the hash code value for this set. 
	 * The hash code of a set is defined to be the sum of the hash codes of 
	 * the elements in the set, where the hash code of a null element is defined to be zero. 
	 * This ensures that s1.equals(s2) implies that s1.hashCode()==s2.hashCode() 
	 * for any two sets s1 and s2, as required by the general contract of Collection.hashCode().
	 * @return string
	 */
	public function hashCode()
	{
		$iterator = $this->iterator();
		
		$code = 0;
		while($iterator->hasNext())
		{
			$code += $iterator->next();
		}
		
		return $code;
	}
}