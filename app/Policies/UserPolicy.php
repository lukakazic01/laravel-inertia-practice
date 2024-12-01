<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    public function create(): bool
    {
        return auth()->user()->email == 'test@gmail.com';
    }

    public function edit(User $user, User $model): bool {
        return $user->email == $model->email;
    }
}
