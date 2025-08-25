<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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
    $payload = [
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];
    $createResponse = $this->postJson('/api/users', $payload);
    $createResponse->assertStatus(201);

    $userId = $createResponse->json('id') ?? 1; // fallback if not returned

    $response = $this->getJson("/api/users/{$userId}");

    $response->assertStatus(200)
        ->assertJsonFragment(['email' => 'test@gmail.com']);
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
    $payload = [
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];
    $createResponse = $this->postJson('/api/users', $payload);
    $createResponse->assertStatus(201);

    $userId = $createResponse->json('id') ?? 1;

    $updatePayload = [
        'name' => 'Edenilson',
        'email' => 'edenilson@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];

    $response = $this->putJson("/api/users/{$userId}", $updatePayload);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'message' => 'User updated successfully',
            'status' => 'user_updated'
        ]);
});

it('deletes a user', function () {
    $payload = [
        'name' => 'Test test',
        'email' => 'test@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];
    $createResponse = $this->postJson('/api/users', $payload);
    $createResponse->assertStatus(201);

    $userId = $createResponse->json('id') ?? 1;

    $response = $this->deleteJson("/api/users/{$userId}");

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