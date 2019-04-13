<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function after_login_user_can_not_access_home_page_until_verified()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get('/home')->assertRedirect('/');
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function after_login_user_can_access_home_page_if_verified()
    {
        $user = factory(User::class)->create(['isVerified' => 1]);
        $this->actingAs($user);
        $this->get('/home')->assertStatus(200);
    }
}
