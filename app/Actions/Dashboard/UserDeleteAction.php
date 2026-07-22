<?php

namespace App\Actions\Dashboard;

use App\Models\User;

class UserDeleteAction
{
    public function execute($user_id)
    {
        return User::where('id',$user_id)->delete();
    }
}
