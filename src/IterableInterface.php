<?php

namespace Jmw\Collection;

/**
 * The iteratable interface is meant to allow a class to be iterated over
 * @author john
 *
 */
interface IterableInterface
{
	/**
	 * Gets an IteratorInterace to iterate over the given object
	 * @return IteratorInterface
	 */
	public function iterator();
}