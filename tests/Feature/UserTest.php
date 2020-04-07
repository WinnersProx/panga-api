<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UserTest extends TestCase
{
    //use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    

    public function return_200_status_when_user_fetch_root_endpoint()
    {
        $response = $this->get('/api');
        $response->assertStatus(200);
        $response->assertJsonStructure([ 'status', 'message']);
    }

    public function test_return_error_when_user_signup_with_invalid_credentials() {
        $response = $this->json('POST','/api/v1/signup');
        $response->assertStatus(400, $response->getStatusCode());
        $response->assertJsonStructure([ 'status', 'errors' ]);
    }

    public function test_create_user_with_valid_credentials_201() {
        $response = $this->postJson('/api/v1/signup', [
            'name' => 'Vainqueur',
            'email' => 'bihames555@gmail.com',
            'password' => 'winners1'
        ]);
        
        $response->assertStatus(201, $response->getStatusCode());
        $response->assertJsonStructure([
            'status',
            'user' => ['name', 'email', 'id']
        ]);
    }

    public function test_return_errors_when_user_already_exists() {
        $response = $this->postJson('/api/v1/signup', [
            'name' => 'Vainqueur',
            'email' => 'bihames555@gmail.com',
            'password' => 'winners1'
        ]);
        
        $response->assertStatus(201, $response->getStatusCode());
        //$response->assertJsonStructure(['status','errors']);
    }

}
