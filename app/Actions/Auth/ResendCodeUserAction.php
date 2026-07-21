<?php

namespace App\Actions\Auth;

use App\Events\OtpGenerated;
use App\Models\OtpCode;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class ResendCodeUserAction
{
    public function execute($user_id)
    {
        $user = User::findOrFail($user_id);
        $code = rand(100000, 999999);

        $key = 'otp:'. $user_id;
        if(RateLimiter::tooManyAttempts($key, 1)) {
            throw new Exception('لطفا دو دقیقه دیگر تلاش کنید');
        }

        OtpCode::updateOrcreate([
            'user_id' => $user_id,
        ],
        [
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(2),
        ]);

        OtpGenerated::dispatch($user,$code);

        RateLimiter::hit($key,120);
    }
}
