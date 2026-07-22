<?php

namespace App\Actions\Dashboard;

use App\Models\User;

class UserListAction
{
    public function execute()
    {
        return User::latest()->paginate(5);
    }
}
