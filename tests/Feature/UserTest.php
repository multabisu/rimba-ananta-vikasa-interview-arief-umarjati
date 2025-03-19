<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_retrieve_all_users()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 30,
        ];

        $this->postJson('/api/users', $userData);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [['id', 'name', 'email', 'age', 'updated_at', 'created_at']]
            ]);
    }

    public function test_it_can_create_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 30,
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
            ->assertJson(['status' => true, 'message' => 'User created successfully']);

        $this->assertDatabaseHas('users', $userData);
    }

    public function test_it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User retrieved successfully']);
    }

    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create();
        $updateData = ['name' => 'Updated Name', 'email' => 'updated@example.com'];

        $response = $this->putJson("/api/users/{$user->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User updated successfully']);

        $this->assertDatabaseHas('users', $updateData);
    }

    public function test_it_can_delete_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 30,
        ];

        $user = $this->postJson('/api/users', $userData);

        $response = $this->deleteJson("/api/users/{$user->data->id}");

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User deleted successfully']);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
