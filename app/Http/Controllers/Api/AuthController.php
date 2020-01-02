<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function register(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'], 
        ]);

        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
    }

    function login(Request $request) {

    }
}
