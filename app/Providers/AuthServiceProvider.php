<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Room;
use App\Models\User;
use App\Models\Token;
use App\Policies\RoomPolicy;
use App\Policies\UserPolicy;
use App\Policies\TokenPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Room::class => RoomPolicy::class,
        Token::class => TokenPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
