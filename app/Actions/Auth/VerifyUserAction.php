<?php

namespace App\Actions\Auth;

use App\Models\OtpCode;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class VerifyUserAction
{
    public function execute($code,$email,$user_id)
    {
        $otp = OtpCode::where('user_id', $user_id)->where('expires_at','>',now())->latest()->first();
        $user = User::where('email', $email)->first();

        if(!$user){
            throw new Exception("کاربری پیدا نشد");
        }

        if(!$otp){
            throw new Exception("کدی پیدا نشد");
        }


        if($otp->expires_at->isPast()){
            $otp->delete();
            session()->forget('login_user_id');
            session()->forget('login_email');

            throw new Exception('کد منقضی شده');
        }

        if($otp->used_at !== null){
            throw new Exception('کد قبلا استفاده شده');
        }

        $key = 'verification_code'.$user_id;
        if(RateLimiter::tooManyAttempts($key, 4)){
            throw new Exception('اکانت موقتا قفل شد');
        }

        if(!Hash::check($code, $otp->code)){
            RateLimiter::hit($key,200);
            throw new Exception('کد وارد شده صحیح نیست');
        }

        RateLimiter::clear($key);
        $otp->update([
            'used_at' => now()
        ]);

        return $user;
    }
}
