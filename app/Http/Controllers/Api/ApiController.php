<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class ApiController extends Controller
{
    function posts(Request $request)
    {
        $posts = Post::all();
        $response = json_encode($posts, JSON_PRETTY_PRINT);

        return $response;
    }
}
