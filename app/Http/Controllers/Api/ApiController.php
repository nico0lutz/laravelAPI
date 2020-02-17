<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class ApiController extends Controller
{   
    /**
     * Pulls all posts from the DB
     * 
     * @param Request
     * @return Posts
     */
    function posts(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $response = json_encode($posts, JSON_PRETTY_PRINT);

        return $response;
    }

    /**
     * Pulls a post specified by an id
     * 
     * @param Request
     * @param id
     * @return Post
     */
    function getPost(Request $request, $id)
    {
        $post = Post::find($id);

        return json_encode($post, JSON_PRETTY_PRINT);
    }

    /**
     * Pulls all posts owned by a specified user from the DB
     * 
     * @param Request
     * @return Posts
     */
    function postsByUser(Request $request)
    {
        $posts = Post::where('author', $request->user()->name)->orderBy('created_at', 'desc')->get();
        $response = json_encode($posts, JSON_PRETTY_PRINT);

        return $response;
    }

    /**
     * Saves a post to the DB
     * 
     * @param Request
     * @return Post
     */
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

    /**
     * Edits a post by given parameters
     * 
     * @param Request
     * @return Post
     */
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

    /** 
     * Deletes a post from the DB
     * 
     * @param Request
     * @return Message
     */
    function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        $this->authorize('delete', $post);
        
        $post->destroy($id);

        $response = ['message' => 'Post was deleted successfully'];

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}
