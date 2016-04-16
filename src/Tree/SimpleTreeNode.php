<?php
namespace Jmw\Collection\Tree;

use Jmw\Collection\Lists\ListInterface;
use Jmw\Collection\Lists\ArrayList;

/**
 * Simple implementation of a tree node.
 * Allows for variable
 * @author john
 *
 */
class SimpleTreeNode implements TreeNodeInterface
{
	/**
	 * @var multitype
	 */
	protected $value;
	
	/**
	 * @var SimpleTreeNode
	 */
	protected $parent;
	
	/**
	 * @var ListInterface
	 */
	protected $children;
	
	/**
	 * Constructs a new SimpleTreeNode
	 * @param multitype $value
	 * @param SimpleTreeNode $parent
	 * @param ListInterface $children
	 */
	public function __construct($value, SimpleTreeNode $parent = null, ListInterface $children = null)
	{
		$this->value = $value;
		
		$this->parent = $parent;
		
		if($children === null)
		{
			$children = new ArrayList();
		}
		
		$this->children = $children;
	}
	
	/**
	 * Returns the children of the receiver as an Enumeration.
	 * @return ListInterface
	 */
	public function children()
	{
		return $this->children;
	}
	
	/**
	 * Returns true if the receiver allows children.
	 * @return boolean
	*/
	public function getAllowsChildren()
	{
		return true;
	}
	
	/**
	 * Returns the child TreeNode at index childIndex.
	 * @param int $index
	 * @return TreeNodeInterface
	*/
	public function getChildAt($index)
	{
		return $this->children->get($index);
	}
	
	/**
	 * Returns the number of children TreeNodes the receiver contains.
	 * @return int
	*/
	public function getChildCount()
	{
		return $this->children->size();
	}
	
	/**
	 * Returns the index of node in the receivers children.
	 * @return int
	*/
	public function getIndex(TreeNodeInterface $node)
	{
		return $this->children->indexOf($node);
	}
	
	/**
	 * Returns the parent TreeNode of the receiver.
	 * @return TreeNodeInterface
	*/
	public function getParent()
	{
		return $this->parent;
	}
	
	/**
	 * Retrieves the value of this TreeNode
	 * @return multitype
	*/
	public function value()
	{
		return $this->value;
	}
	
	/**
	 * Injects a node into the current tree structure,
	 * such that the node at the specified index becomes
	 * a child of the injected node, and the injected node
	 * moves to the specified index in the receiver
	 * @param int $index
	 * @param TreeNodeInterface $node
	 */
	public function injectAt($index, TreeNodeInterface $node)
	{
		$node->insert($this->children->get($index));
		$this->replaceAt($index, $node);
	}
	
	/**
	 * Adds child to the receiver at index.
	 * @param TreeNodeInterface $nodex
	 * @return void
	*/
	public function insert(TreeNodeInterface $node)
	{
		$node->setParent($this);
		$this->children->add($node);
	}
	
	/**
	 * Adds child to the receiver at index.
	 * @param int $index
	 * @param TreeNodeInterface $node
	 * @return void
	 */
	public function insertAt($index, TreeNodeInterface $node)
	{
		$node->setParent($this);
		$this->children->addAt($index, $node);
	}
	
	/**
	 * Returns true if the receiver is a leaf.
	 * @return boolean
	*/
	public function isLeaf()
	{
		return $this->children->isEmpty();
	}
	
	/**
	 * Removes node from the receiver.
	 * @param TreeNodeInterface $node
	*/
	public function remove(TreeNodeInterface $node)
	{
		$this->children->remove($node);
	}
	
	/**
	 * Removes the child at index from the receiver.
	 * @param int $index
	*/
	public function removeAt($index)
	{
		$this->children->removeAt($index);
	}
	
	/**
	 * Removes the receiver from its parent.
	 * @return void
	 */
	public function removeFromParent()
	{
		if($this->parent !== null)
		{
			$this->parent->children()->remove($this);
		}
	}
	
	/**
	 * Replace the node at the specified index in the
	 * receiver with the node argument
	 * @param int $index
	 * @param TreeNodeInterface $node
	 */
	public function replaceAt($index, TreeNodeInterface $node)
	{
		$node->setParent($this);
		$this->children->removeAt($index);
		$this->children->addAt($index, $node);
	}
	
	/**
	 * Sets the parent of the receiver to newParent.
	 * @param TreeNodeInterface $node
	*/
	public function setParent(TreeNodeInterface $node)
	{
		$this->parent = $node;
	}
	
	/**
	 * Sets the receiver's value
	 * @param multitype $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}
	
	/**
	 * Outputs to stdout a simplistic representation of this node and
	 * it's children
	 * @param number $level
	 */
	public function toString($level = 0)
	{
		$output = "";
		for($i = 0; $i < $level; $i++)
		{
			$output .= "\t";
		}
		
		$output .= print_r($this->value(), true);
		
		$output .= "\n";
		
		$iterator = $this->children->iterator();
		
		while($iterator->hasNext())
		{
			$output .= $iterator->next()->toString($level + 1);
		}
		
		return $output;
	}
}