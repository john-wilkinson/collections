<?php
namespace Jmw\Collection\Exception;

/**
 * Thrown when an operation has been called that
 * is not supported by the given collection.
 * 
 * In general, this should only be used by certain types
 * of read-only or immutable collections which have the 
 * ImmutableCollectionTrait
 * @author john
 *
 */
class UnsupportedOperationException extends CollectionException
{
	/**
	 * @var string
	 */
	protected $operation;
	
	/**
	 * @param string $operation
	 */
	public function __construct($operation)
	{
		$this->operation = $operation;
		parent::__construct("The $operation operation is not supported");
	}
	
	/**
	 * Gets the attempted operation
	 * @return string
	 */
	public function getOperation()
	{
		return $this->operation;
	}
}