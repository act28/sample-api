<?php

namespace App\Models\BinaryTree;

use SebastianBergmann\CodeCoverage\Report\PHP;

class BinaryTree
{
    /**
     * Node value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Left child node.
     *
     * @var BinaryTree|null
     */
    protected $left = null;

    /**
     * Right child node.
     *
     * @var BinaryTree|null
     */
    protected $right = null;

    /**
     * Get node value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set node value.
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get left node.
     *
     * @return BinaryTree
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Get right node.
     *
     * @return BinaryTree
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set left node.
     *
     * @param BinaryTree $left
     */
    public function setLeft(BinaryTree $left)
    {
        $this->left = $left;
    }

    /**
     * Set right node.
     *
     * @param BinaryTree $right
     */
    public function setRight(BinaryTree $right)
    {
        $this->right = $right;
    }

    /**
     * Create the binary tree given an array of nodes
     *
     * @param array $node
     * @return $this
     */
    public static function create($node)
    {
        return (new self)->insertNode($node);
    }

    /**
     * Insert a node into the tree.
     *
     * @param array $node
     * @return $this
     */
    protected function insertNode($node)
    {
        $this->setValue(array_get($node, 'root'));
        if (array_get($node, 'left')) {
            // set left subtree
            $this->setLeft((new self)->insertNode(array_get($node, 'left')));
        }
        if (array_get($node, 'right')) {
            // set right subtree
            $this->setRight((new self)->insertNode(array_get($node, 'right')));
        }

        return $this;
    }

    /**
     * Find the smallest leaf value.
     *
     * @param null $min
     * @return mixed
     */
    public function findSmallestLeaf(&$min = null)
    {
        if ($min === null) {
            // if $min is not initialized, initialize it to something large
            // so that the minimum leaf value can be found
            // worst case scenario, $min will be equal to PHP_INT_MAX
            $min = PHP_INT_MAX;
        }

        if ($this->getLeft() !== null) {
            // keep going left until there is a leaf
            $this->getLeft()->findSmallestLeaf($min);
        }

        if ($this->getRight() !== null) {
            // keep going right until there is a leaf
            $this->getRight()->findSmallestLeaf($min);
        }

        // at a leaf
        if ($this->getLeft() === null && $this->getRight() === null) {
            $min = min($min, $this->getValue());
        }

        return $min;
    }
}