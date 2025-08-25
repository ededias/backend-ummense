<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create an authenticated user for all tests
    $this->authenticatedUser = User::factory()->create();
    $this->actingAs($this->authenticatedUser);
});

it('gets all users', function () {
    // First, create a user via the API
    $payload = [
        'name' => 'Test Test',
        'email' => 'test@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];
    $this->postJson('/api/users', $payload);

    $response = $this->getJson('/api/users');
    
    $response->assertStatus(200)
        ->assertJsonFragment(['email' => 'test@gmail.com']);
});

it('gets a user by id', function () {
    // Create user directly in database since API doesn't return ID
    $user = User::create([
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => bcrypt('123456')
    ]);

    $response = $this->getJson("/api/users/{$user->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $user->id,
            'name' => 'Test test',
            'email' => 'test@gmail.com'
        ]);
});



it('creates a user', function () {
    $payload = [
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];

    $response = $this->postJson('/api/users', $payload);

    $response->assertStatus(201)
        ->assertJsonFragment([
            'message' => 'User created successfully',
            'status' => 'user_created'
        ]);
});

it('updates a user', function () {
    // Create user directly in database since API doesn't return ID
    $user = User::create([
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => bcrypt('123456')
    ]);

    $updatePayload = [
        'name' => 'Edenilson',
        'email' => 'edenilson@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];

    $response = $this->putJson("/api/users/{$user->id}", $updatePayload);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'message' => 'User updated successfully',
            'status' => 'user_updated'
        ]);
});

it('deletes a user', function () {
    // Create user directly in database since API doesn't return ID
    $user = User::create([
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => bcrypt('123456')
    ]);

    $response = $this->deleteJson("/api/users/{$user->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'message' => 'User deleted successfully',
            'status' => 'user_deleted'
        ]);
});

it('returns 404 for non-existent user', function () {
    $response = $this->getJson('/api/users/99999');
   
    $response->assertStatus(404)
        ->assertJsonStructure(['message', 'status']);
});

it('validates user creation', function () {
    $payload = [
        'name' => '',
        'email' => 'not-an-email',
        'password' => '',
    ];

    $response = $this->postJson('/api/users', $payload);
    
    $response->assertStatus(422)
        ->assertJsonStructure(['message', 'errors']);
});

// Additional test for authentication requirements
it('requires authentication to access users endpoint', function () {
    // Create a new test instance without authentication
    $this->app->make('auth')->forgetGuards();
    
    $response = $this->getJson('/api/users');
    
    $response->assertStatus(401); // or whatever your auth middleware returns
});