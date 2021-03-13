<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $password = $this->faker()->password;
        $storeName = $this->faker()->company;
        $storeIdentifier = strtolower(str_replace(' ', '', $storeName));

        $response = $this->post('/register', [
            'name' => $this->faker()->name,
            'email' => $this->faker()->unique()->email,
            'password' => $password,
            'password_confirmation' => $password,
            'store_name' => $storeName,
            'store_identifier' => $storeIdentifier
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect("http://$storeIdentifier.localhost/admin");
    }
}
