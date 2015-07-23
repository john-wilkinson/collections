<?php
namespace Jmw\Collection;

/**
 * This class is meant as a binding between a Collection iterator, and php's
 * default iteration scheme. Due to the implicit between the iteration approaches,
 * it leaves the specifics of implementing the methods up to the user.
 * @author john
 *
 */
class IteratorAbstract implements IteratorInterface, \Iterator
{
}