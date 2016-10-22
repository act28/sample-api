<?php

namespace App\Tests;

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

        // in-order traversal FTW!
        $stack = collect($nodes)->flatten()->all();

        $this->assertEquals(2, min($stack));
    }
}