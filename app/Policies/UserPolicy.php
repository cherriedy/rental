<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function update(User $user, User $model): bool {
        return $user->is($model) || $user->isAdmin;
    }

    // public function delete(User $user, User $model): bool {
    //     return $user->is($model) ||  $user->idAdmin;
    // }

    public function delete(User $user): bool {
        return $user->idAdmin;
    }

}
