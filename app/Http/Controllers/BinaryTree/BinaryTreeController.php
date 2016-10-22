<?php

namespace App\Http\Controllers\BinaryTree;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BinaryTreeController extends Controller
{
    /**
     * Find minimum value in an unsorted binary tree given a sample json input
     */
    public function findMin()
    {
        $data = Storage::disk('fixtures')->get('sample-tree.json');
        $nodes = json_decode($data, true);

        // in-order traversal FTW!
        $stack = collect($nodes)->flatten()->all();
        return min($stack);
    }
}