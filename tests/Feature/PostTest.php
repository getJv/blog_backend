<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;


class PostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        /**
         * I cant use RefreshDatabase ... some problem with Hybrid databases... 
         * Here is an workAround :D
         */
        \Artisan::call('migrate:refresh --seed');
        \Artisan::call('passport:install');
    }



    /** @test  */
    public function unknow_user_cant_add_posts()
    {

        // $this->withoutExceptionHandling();

        $response = $this->createPost();

        $response->assertStatus(401);
    }

    /** @test  */
    public function known_users_can_add_posts()
    {

        //$token = $this->getToken('jhonatanvinicius@gmail.com','secret');

        

        $user = factory(User::class)->create();
        Passport::actingAs($user);
        $token = $user->createToken('MyApp')->accessToken;
        $response = $this->createPost($token);
        $response->assertStatus(200);
    }

    private function createPost($token = null)
    {
        return $this->post('api/post', [
            'title' => 'my great Post',
            'content' => 'my Post bla bla bla',
            'image' => 'http://www.tests.com'
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    private function getToken($user, $pass)
    {
        $response = $this->post('api/login', [
            'username' => $user,
            'password' => $pass,
        ], [
            'Accept' => 'application/json',
        ]);

        return json_decode($response->getContent())->access_token;
    }
}
