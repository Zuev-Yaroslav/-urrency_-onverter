<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    private const PREFIX_API = '/api/v1';
    private function login($data)
    {
        return $this->post(self::PREFIX_API . '/auth/login', $data)->collect()['access_token'];
    }
    public function test_index_unauthorized(): void
    {
        $response = $this->get(self::PREFIX_API . '/currencies');

        $response->assertUnauthorized();
    }
    public function test_index_authorized(): void
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user6567',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $token = $this->login($data);
        $response = $this->withToken($token)->get(self::PREFIX_API . '/currencies');

        $response->assertJsonPath('USD.charCode', 'USD');
        $response->assertJsonPath('EUR.charCode', 'EUR');
        $response->assertStatus(200);
    }
    public function test_show_kzt()
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user6567',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $token = $this->login($data);

        $response = $this->withToken($token)->get(self::PREFIX_API . '/currencies/KZT');

        $response->assertOk();
        $response->assertJsonPath('charCode', 'KZT');
    }
    public function test_show_jsh_not_found()
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user6567',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $token = $this->login($data);

        $response = $this->withToken($token)->get(self::PREFIX_API . '/currencies/JSH');

        $response->assertNotFound();
        $response->assertJsonPath('message', 'Currency not found');
    }
    public function test_exchange()
    {
        $data = ['email' => 'super_user@ru', 'password' => 'password'];
        User::create([
            'name' => 'user6567',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $token = $this->login($data);

        $response = $this->withToken($token)
            ->get(self::PREFIX_API . '/currencies/exchange?char_code=EUR&total=24.345');
//        $eur = $this->withToken($token)->get(self::PREFIX_API . '/currencies/EUR')->collect();
        $response->assertStatus(200);
    }
}
