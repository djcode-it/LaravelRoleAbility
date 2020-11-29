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

        // Gate based on Roles
        Role::all()->each(function (Role $role) {
            Gate::define($role->sku, function (User $user) use ($role) {
                return $user->roles->contains('sku', $role->sku);
            });
        });

        // Gate Based On Multiple Roles
        Ability::all()->each(function (Ability $ability) {
            Gate::define($ability->sku, function (User $user) use ($ability) {

                $check = false;
                foreach ($user->roles as $role) {
                    if ($role->abilities->contains('sku', $ability->sku)) {
                        $check = true;
                        break;
                    }
                }
                return $check;

            });
        });


    }
}
