<?php

namespace App\Providers;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('edit-settings', function (User $user) {
//            return $user->isAdmin;
//        });

        Ability::all()->each(function ($role) {
            Gate::define($role->sku, function (User $user) {
                return $user->isAdmin;
            });
        });

        // Return All Abilities
//        dd(
//            Gate::abilities()
//        );
    }
}
