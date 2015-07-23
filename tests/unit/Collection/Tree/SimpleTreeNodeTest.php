<?php

use Jmw\Collection\Tree\SimpleTreeNode;
class SimpleTreeNodeTest extends PHPUnit_Framework_TestCase
{
	public $tree;
	
	public function setUp()
	{
		$this->tree = new SimpleTreeNode('root');
		
		$this->tree->insert(new SimpleTreeNode('fruits'));
		$this->tree->insert(new SimpleTreeNode('colors'));
		$this->tree->insert(new SimpleTreeNode('booleans'));
		
		$this->tree->getChildAt(0)->insert(new SimpleTreeNode('apple'));
		$this->tree->getChildAt(0)->insert(new SimpleTreeNode('banana'));
		$this->tree->getChildAt(0)->insert(new SimpleTreeNode('cherry'));
		

		$this->tree->getChildAt(1)->insert(new SimpleTreeNode('red'));
		$this->tree->getChildAt(1)->insert(new SimpleTreeNode('blue'));
		$this->tree->getChildAt(1)->insert(new SimpleTreeNode('green'));
		$this->tree->getChildAt(1)->insert(new SimpleTreeNode('yellow'));
		

		$this->tree->getChildAt(2)->insert(new SimpleTreeNode('true'));
		$this->tree->getChildAt(2)->insert(new SimpleTreeNode('false'));
	}
	
	public function testChildren()
	{
		$letters = $this->tree->getChildCount();
		
		$this->assertEquals(3, $letters);
		
		$fruits = $this->tree->getChildAt(0)->getChildCount();
		
		$this->assertEquals(3, $fruits);
		
		$colors = $this->tree->getChildAt(1)->getChildCount();
		
		$this->assertEquals(4, $colors);
		
		$booleans = $this->tree->getChildAt(2)->getChildCount();
		
		$this->assertEquals(2, $booleans);
	}

	public function testGetAllowsChildren()
	{
		$this->assertTrue($this->tree->getAllowsChildren());
	}

	public function testGetChildAt()
	{
		$fruits = $this->tree->getChildAt(0);
		
		$this->assertEquals('fruits', $fruits->value());
		
		$this->assertEquals('banana', $fruits->getChildAt(1)->value());
	}
	
	public function testGetChildCount()
	{
		$rootCount = $this->tree->getChildCount();
		
		$this->assertEquals(3, $rootCount);
		
		$colorsCount = $this->tree->getChildAt(1)->getChildCount();
		
		$this->assertEquals(4, $colorsCount);
	}

	public function testGetIndex()
	{
		$child = $this->tree->getChildAt(2);
		$index = $this->tree->getIndex($child);
		$this->assertEquals(2, $index);
	}

	public function testGetParent()
	{
		$booleans = $this->tree->getChildAt(2)->getChildAt(0)->getParent();
		$this->assertEquals('booleans', $booleans->value());
	}

	public function testValue()
	{
		$value = $this->tree->value();
		
		$this->assertEquals('root', $value);
	}
	
	public function testInjectAt()
	{
		$this->tree->injectAt(0, new SimpleTreeNode('food'));
				
		$this->assertEquals('food', $this->tree->getChildAt(0)->value());
		$this->assertEquals('fruits', $this->tree->getChildAt(0)->getChildAt(0)->value());
		
		$food = $this->tree->getChildAt(0);
				
		$this->assertEquals('root', $food->getParent()->value());
	}

	public function testInsert()
	{
		//this is taken care of in the setup, effectively
	}

	public function testInsertAt()
	{		
		$this->tree->insertAt(2, new SimpleTreeNode('serenity'));
				
		$this->assertEquals('serenity', $this->tree->getChildAt(2)->value());
	}

	public function testIsLeaf()
	{
		$this->assertFalse($this->tree->isLeaf());
		
		$this->assertTrue($this->tree->getChildAt(0)->getChildAt(0)->isLeaf());
	}

	public function testRemove()
	{
		$this->tree->remove($this->tree->getChildAt(0));
		
		$this->assertEquals('colors', $this->tree->getChildAt(0)->value());
	}

	public function testRemoveAt()
	{
		$this->tree->removeAt(1);
		
		$this->assertEquals('booleans', $this->tree->getChildAt(1)->value());
	}

	public function testRemoveFromParent()
	{
		$this->tree->getChildAt(0)->removeFromParent();
		$this->tree->getChildAt(0)->removeFromParent();
		$this->tree->getChildAt(0)->removeFromParent();
		
		$this->assertTrue($this->tree->isLeaf());
	}

	public function testSetParent()
	{
		$this->tree->setParent(new SimpleTreeNode('base'));
		
		$this->assertEquals('base', $this->tree->getParent()->value());
	}
	
	public function testReplaceAt()
	{
		$this->tree->replaceAt(0, new SimpleTreeNode('empty1'));
		
		$this->assertTrue($this->tree->getChildAt(0)->isLeaf());
		
// 		echo "\n";
// 		$this->tree->printTree();
		
		$this->tree->replaceAt(1, new SimpleTreeNode('empty2'));
// 		$this->tree->printTree();
		
		$this->tree->replaceAt(2, new SimpleTreeNode('empty3'));
// 		$this->tree->printTree();
		
	}

	
	public function testSetValue()
	{
		$this->tree->setValue('base');
		
		$this->assertEquals('base', $this->tree->value());
	}
	
	public function testPrintTree()
	{
		$expected = "root\n\tfruits\n\t\tapple\n\t\tbanana\n\t\tcherry\n\tcolors\n\t\tred\n\t\tblue\n\t\tgreen\n\t\tyellow\n\tbooleans\n\t\ttrue\n\t\tfalse\n";
		
		ob_start();
		
		$this->tree->printTree();
		
		$buffer = ob_get_clean();
		
		$this->assertEquals($expected, $buffer);
	}
}