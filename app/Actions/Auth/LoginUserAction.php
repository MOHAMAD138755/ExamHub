<?php

namespace App\Actions\Auth;

use App\Events\OtpGenerated;
use App\Mail\LoginOtpCode;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginUserAction
{
    public function execute($userDate)
    {
        $user = User::create(['email' => $userDate]);
        $code = rand(100000, 999999);

        OtpCode::create([
            'user_id' => $user->id,
            'expires_at' => now()->addMinutes(2),
            'code' => Hash::make($code),
        ]);

        OtpGenerated::dispatch($user, $code);

        return $user;
    }
}
