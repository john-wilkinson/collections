<?php 
namespace Jmw\Collection\Lists;

use Jmw\Collection\ImmutableCollectionTrait;
use Jmw\Collection\Exception\UnsupportedOperationException;
/**
 * This trait is ensures immutability by throwing an exception
 * on all mutable ListInterface methods
 * @author john
 *
 */
trait ImmutableListTrait
{
	use ImmutableCollectionTrait;
	
	/**
	 * @throws UnsupportedOperationException
	 */
	public function addAt($index, $element)
	{
		throw new UnsupportedOperationException('addAt');
	}
	
	/**
	 * @throws UnsupportedOperationException
	 */
	public function removeAt($index)
	{
		throw new UnsupportedOperationException('removeAt');
	}
	
	/**
	 * @throws UnsupportedOperationException
	 */
	public function set($index, $element)
	{
		throw new UnsupportedOperationException('set');
	}
	
	/*********************************************
	 ** Array Access Methods
	 *********************************************/
		
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value)
	{
		throw new UnsupportedOperationException('offsetSet');
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset)
	{
		throw new UnsupportedOperationException('offsetUnset');
	}
}