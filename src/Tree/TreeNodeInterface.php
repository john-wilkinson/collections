<?php
namespace Jmw\Collection\Tree;

/**
 * Defines the requirements for an object that can be used as a tree node
 * @author john
 *
 */
interface TreeNodeInterface
{
	/**
	 * Returns the children of the receiver as an Enumeration.
	 * @return ListInterface
	 */
	public function children();
	
	/**
	 * Returns true if the receiver allows children.
	 * @return boolean
	 */
	public function getAllowsChildren();
	
	/**
	 * Returns the child TreeNode at index childIndex.
	 * @param int $index
	 * @return TreeNodeInterface
	 */
	public function getChildAt($index);
	
	/**
	 * Returns the number of children TreeNodes the receiver contains.
	 * @return int
	 */
	public function getChildCount();
	
	/**
	 * Returns the index of node in the receivers children.
	 * @return int
	 */
	public function getIndex(TreeNodeInterface $node);
	
	/**
	 * Returns the parent TreeNode of the receiver.
	 * @return TreeNodeInterface
	 */
	public function getParent();
	
	/**
	 * Retrieves the value of this TreeNode
	 * @return multitype
	 */
	public function value();
	
	/**
	 * Injects a node into the current tree structure,
	 * such that the node at the specified index becomes
	 * a child of the injected node, and the injected node
	 * moves to the specified index in the receiver
	 * @param int $index
	 * @param TreeNodeInterface $node
	 */
	public function injectAt($index, TreeNodeInterface $node);
	
	/**
	 * Adds child to the receiver at index.
	 * @param TreeNodeInterface $node
	 * @return void
	 */
	public function insert(TreeNodeInterface $node);
	
	/**
	 * Adds child to the receiver at index.
	 * @param int $index
	 * @param TreeNodeInterface $node
	 * @return void
	 */
	public function insertAt($index, TreeNodeInterface $node);
	
	/**
	 * Returns true if the receiver is a leaf.
	 * @return boolean
	 */
	public function isLeaf();
	
	/**
	 * Removes node from the receiver.
	 * @param TreeNodeInterface $node
	 * @return void
	 */
	public function remove(TreeNodeInterface $node);
	
	/**
	 * Removes the child at index from the receiver.
	 * @param int $index
	 * @return void
	 */
	public function removeAt($index);
	
	/**
	 * Removes the receiver from its parent.
	 * @return void
	 */
	public function removeFromParent();
	
	/**
	 * Replace the node at the specified index in the
	 * receiver with the node argument
	 * @param int $index
	 * @param TreeNodeInterface $node
	 */
	public function replaceAt($index, TreeNodeInterface $node);
	
	/**
	 * Sets the parent of the receiver to newParent.
	 * @param TreeNodeInterface $node
	 * @return void
	 */
	public function setParent(TreeNodeInterface $node);
	
	/**
	 * Sets the receiver's value
	 * @param multitype $value
	 */
	public function setValue($value);
}