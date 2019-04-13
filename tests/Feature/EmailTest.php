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
    use DatabaseMigrations;
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
}
