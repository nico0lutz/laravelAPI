<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'Api\ApiController@posts');

Route::middleware('auth:api')->post('/addPost', 'Api\ApiController@storePost');

Route::middleware('auth:api')->get('/myPosts', 'Api\ApiController@postsByUser');

Route::get('/post/{id}', 'Api\ApiController@getPost');

Route::middleware('auth:api')->delete('deletePost/{id}', 'Api\ApiController@deletePost');

Route::middleware('auth:api')->put('editPost', 'Api\ApiController@editPost');