<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function update(User $user): bool
    {
        return $user->is(Auth::user());
    }

    // public function delete(User $user, User $model): bool {
    //     return $user->is($model) ||  $user->idAdmin;
    // }

    // public function delete(User $user): bool {
    //     return $user->idAdmin;
    // }

    public function login() {
        // return !Auth::check();
        return true;
    }
}
