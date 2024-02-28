<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $user, User $currentUser): bool
    {
        return $user->is($currentUser);
    }

    public function getAccountBalance(User $user, User $currentUser): bool
    {
        return $user->is($currentUser);
    }
}
