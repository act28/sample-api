<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group(['prefix' => 'api/library', 'namespace' => 'App\Http\Controllers\Library'], function () use ($app) {
    $app->get('{id}', ['as' => 'get-library-by-id', 'uses' => 'LibraryController@show']);

    $app->post('/', ['middleware' => 'valid-token', 'as' => 'add-library', 'uses' => 'LibraryController@store']);
});

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers\BinaryTree'], function () use ($app) {
    $app->get('findSmallestLeaf', ['as' => 'find-smallest-leaf', 'uses' => 'BinaryTreeController@smallestLeft']);
});
