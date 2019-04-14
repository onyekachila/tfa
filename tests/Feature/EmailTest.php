<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class EmailTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_email_is_sent_when_a_user_is_logged_in()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        // making a post request to /login with the user email and password will get us the authenticated user.
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        Mail::assertSent(OTPMail::class);
    }

    /**
    * A basic feature test example.
    * @test
    * @return void
    */
    public function an_otp_email_is_not_sent_if_credentials_are_incorrect()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        // making a post request to /login with the user email and password will get us the authenticated user.
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'sdsdsd']);
        Mail::assertNotSent(OTPMail::class);
    }

    public function otp_is_stored_in_cache_for_the_user()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertNotNull($user->OTP());
    }
}
