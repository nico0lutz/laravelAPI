<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class ApiController extends Controller
{
    function posts(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $response = json_encode($posts, JSON_PRETTY_PRINT);

        return $response;
    }

    function getPost(Request $request, $id)
    {
        $post = Post::find($id);

        return json_encode($post, JSON_PRETTY_PRINT);
    }

    function postsByUser(Request $request)
    {
        $posts = Post::where('author', $request->user()->name)->orderBy('created_at', 'desc')->get();
        $response = json_encode($posts, JSON_PRETTY_PRINT);

        return $response;
    }

    function storePost(Request $request)
    {
        $post = new Post;
        $author = $request->user()->name;

        $post->author = $author;
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        $response = ['message' => 'Post was added successfully', 'data' => [
            'author' => $author,
            'title' => $request->title,
            'content' => $request->content,
        ]];

        return json_encode($response, JSON_PRETTY_PRINT);
    }

    function editPost(Request $request)
    {   
        $post = Post::find($request->id);
        
        $this->authorize('update', $post);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        $response = ['message' => 'Post was edited successfully', 'data' => [
            'title' => $request->title,
            'content' => $request->content,
        ]];

        return json_encode($response, JSON_PRETTY_PRINT);
    }

    function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        $this->authorize('delete', $post);
        
        $post->destroy($id);

        $response = ['message' => 'Post was deleted successfully'];

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}
