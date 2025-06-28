<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Laravel API Template',
        'version' => '1.0.0',
        'endpoints' => [
            'auth' => [
                'POST /api/register' => 'Register a new user',
                'POST /api/login' => 'Login user',
                'POST /api/logout' => 'Logout user (requires auth)',
                'GET /api/user' => 'Get current user (requires auth)'
            ],
            'users' => [
                'GET /api/users' => 'Get all users (requires auth)',
                'POST /api/users' => 'Create a new user (requires auth)',
                'GET /api/users/{id}' => 'Get specific user (requires auth)',
                'PUT /api/users/{id}' => 'Update user (requires auth)',
                'DELETE /api/users/{id}' => 'Delete user (requires auth)'
            ],
            'posts' => [
                'GET /api/posts' => 'Get all posts (requires auth)',
                'POST /api/posts' => 'Create a new post (requires auth)',
                'GET /api/posts/{id}' => 'Get specific post (requires auth)',
                'PUT /api/posts/{id}' => 'Update post (requires auth)',
                'DELETE /api/posts/{id}' => 'Delete post (requires auth)',
                'GET /api/my-posts' => 'Get current user posts (requires auth)'
            ],
            'health' => [
                'GET /api/health' => 'Health check endpoint'
            ]
        ]
    ]);
});
