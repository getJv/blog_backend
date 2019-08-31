<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Post;
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
        \Artisan::call('migrate:refresh');
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

        $response = $this->createPost($this->getToken());
        $response->assertOk();
        $this->assertCount(1, Post::all());
    }

    /** @test  */
    public function anyone_can_get_posts()
    {

        $this->createPost($this->getToken());
        $this->createPost($this->getToken());
        $this->createPost($this->getToken());
        $response = $this->get('api/posts');
        $response->assertOk();
        $posts = json_decode($response->getContent());
        $this->assertCount(3, $posts);
    }

    /** @test  */
    public function anyone_can_read_posts()
    {

        $response = $this->createPost($this->getToken());
        $id = json_decode($response->getContent())->id;
        $this->get("api/post/{$id}");
        $response->assertOk();
        
    }


    private function createPost($token = null)
    {
        return $this->post('api/post', [
            'title' => 'my great Post',
            'content' => 'my Post bla bla bla',
            'image' => 'http://www.tests.com',
            'liked' => false
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    private function getToken()
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);
        return $user->createToken('MyApp')->accessToken;
    }
}
