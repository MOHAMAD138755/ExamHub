<?php

namespace App\Actions\Auth;

use App\Events\OtpGenerated;
use App\Mail\LoginOtpCode;
use App\Models\OtpCode;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginUserAction
{
    public function execute($userDate)
    {
        $user = User::firstOrcreate(['email' => $userDate]);
        $code = rand(100000, 999999);
        $otp = OtpCode::where('user_id', $user->id)->first();

        if(!$otp || $otp->expires_at->isPast()) {

            OtpCode::updateOrcreate(
                [
                    'user_id' => $user->id,
                ]
                , [
                'expires_at' => now()->addMinutes(4),
                'code' => Hash::make($code),
            ]);

            OtpGenerated::dispatch($user, $code);
        }else{
            throw new Exception('کد قبلا ارسال شده');
        }

        return $user;
    }
}
