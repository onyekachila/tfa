<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerifyOTPController extends Controller
{
    public function verify(Request $request)
    {
        // dd(request('OTP'));  // this is to test we are getting the otp from the test class

        if (request('OTP') === Cache::get('OTP')) {
            auth()->user()->update(['isVerified' => true]);
            return response(null, 201);
        }
    }
}
