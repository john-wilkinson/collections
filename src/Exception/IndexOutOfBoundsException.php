<?php
namespace Jmw\Collection\Exception;

/**
 * Thrown when the given index is out of bounds
 * @author john
 *
 */
class IndexOutOfBoundsException extends CollectionException
{
	/**
	 * 
	 * @var int
	 */
	protected $index;
	
	/**
	 * 
	 * @param int $index
	 */
	public function __construct($index)
	{
		$this->index = $index;
		parent::__construct("$index was out of bounds");
	}
	
	/**
	 * 
	 * @return number
	 */
	public function getIndex()
	{
		return $this->index;
	}
}