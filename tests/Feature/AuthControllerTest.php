<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        // Tambahkan data user langsung ke dalam basis data
        // DB::table('users')->insert([
        //     'name' => 'robbi',
        //     'email' => 'robbirodhiyan@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role' => 1, // Sesuaikan dengan role yang diperlukan
        // ]);

        $response = $this->postJson('/api/login', [
            'email' => 'robbirodhiyan@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }
}
