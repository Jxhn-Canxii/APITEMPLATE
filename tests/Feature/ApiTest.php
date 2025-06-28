<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_check_endpoint()
    {
        $response = $this->get('/api/health');

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => 'API is running'
                ]);
    }

    public function test_user_registration()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
                ->assertJson([
                    'status' => true,
                    'message' => 'User registered successfully'
                ])
                ->assertJsonStructure([
                    'data' => [
                        'user' => ['id', 'name', 'email'],
                        'token',
                        'token_type'
                    ]
                ]);
    }

    public function test_user_login()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123')
        ]);

        $loginData = [
            'email' => 'john@example.com',
            'password' => 'password123'
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => 'Login successful'
                ])
                ->assertJsonStructure([
                    'data' => [
                        'user' => ['id', 'name', 'email'],
                        'token',
                        'token_type'
                    ]
                ]);
    }

    public function test_create_post_with_authentication()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $postData = [
            'title' => 'Test Post',
            'content' => 'This is a test post content.',
            'status' => 'published'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/posts', $postData);

        $response->assertStatus(201)
                ->assertJson([
                    'status' => true,
                    'message' => 'Post created successfully'
                ]);
    }

    public function test_get_posts_with_authentication()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/posts');

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => 'Posts retrieved successfully'
                ]);
    }
} 