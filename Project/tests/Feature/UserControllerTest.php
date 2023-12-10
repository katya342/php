<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Hash;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testUserRegistration()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['user' => ['name' => 'John', 'email' => 'john@example.com']]);
    }
}
