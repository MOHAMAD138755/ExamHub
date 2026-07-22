<?php

namespace App\Actions\Dashboard;

use App\Models\User;

class UserListAction
{
    public function execute($search)
    {
        return User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5);
    }
}
