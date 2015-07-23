<?php
namespace Jmw\Collection\Exception;

/**
 * Thrown when an invalid type is encountered
 * Allows certain collections to have a modicum 
 * of type checking
 * @author john
 *
 */
class InvalidTypeException extends CollectionException
{
	/**
	 * 
	 * @var multitype
	 */
	protected $expected;
	
	/**
	 * 
	 * @var multitype
	 */
	protected $received;
	
	/**
	 * 
	 * @param multitype $expected
	 * @param multitype $received
	 */
	public function __construct($expected, $received)
	{
		$this->expected = $expected;
		$this->received = $received;
		
		parent::__construct("Expected {$expected}, received $received");
	}
	
	/**
	 * 
	 * @return multitype
	 */
	public function getExpected()
	{
		return $this->expected;
	}
	
	/**
	 * 
	 * @return multitype
	 */
	public function getReceived()
	{
		return $this->received;
	}
}