<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private const PREFIX_API = '/api/v1';
    private function login($data)
    {
        return $this->post(self::PREFIX_API . '/auth/login', $data);
    }
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $response = $this->login($data);

        $response->assertStatus(200);
    }
    public function test_bad_login(): void
    {
        $data = ['email' => 'super_user@ru', 'password' => 'passwor'];
        $response = $this->login($data);

        $response->assertStatus(401);
    }
    public function test_bad_login_2(): void
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $data['email'] = 'sfw@defe';
        $response = $this->login($data);

        $response->assertStatus(401);
    }
}
