<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;

class VerifyOtpTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function a_user_can_submit_otp_and_get_verified()
    {
        $this->withoutExceptionHandling(); // help to get specifics of the error
        $OTP = rand(100000, 999999);
        Cache::put(['OTP' => $OTP], now()->addSeconds(20));
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('/verifyOTP', ['OTP' => $OTP])->assertStatus(201);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }
}
