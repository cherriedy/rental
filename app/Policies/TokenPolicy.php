<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenPolicy
{
    public function reset() : bool
    {
        // return !(Auth::check());
        return true;
    }
}
