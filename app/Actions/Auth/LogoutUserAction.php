<?php

namespace App\Actions\Auth;

use App\Models\OtpCode;
use Illuminate\Support\Facades\Auth;

class LogoutUserAction
{
    public function execute()
    {
        OtpCode::where('user_id', Auth::id())->delete();
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}
