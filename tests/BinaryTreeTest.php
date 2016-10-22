<?php

namespace App\Tests;

use App\Models\BinaryTree\BinaryTree;
use App\Models\BinaryTree\BinaryTreeIterator;
use Illuminate\Support\Facades\Storage;
use TestCase;

class BinaryTreeTest extends TestCase
{
    /**
     * Test can find smallest leaf
     */
    public function test_find_smallest_leaf()
    {
        $data = Storage::disk('fixtures')->get('sample-tree.json');
        $nodes = json_decode($data, true);

        $tree = BinaryTree::create($nodes);
        $min = $tree->findSmallestLeaf();
        $this->assertEquals(2, $min);

        $data = Storage::disk('fixtures')->get('sample-tree2.json');
        $nodes = json_decode($data, true);

        $tree2 = BinaryTree::create($nodes);
        $min = $tree2->findSmallestLeaf();
        $this->assertEquals(4, $min);
    }
}