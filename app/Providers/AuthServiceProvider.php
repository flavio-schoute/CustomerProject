<?php

namespace App\Providers;

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

        Gate::define('create-accounts', function (User $user) {
            return $user->role_id == Role::IS_ADMIN;
        });

        Gate::define('import-accounts', function (User $user) {
            return $user->role_id == Role::IS_ADMIN;
        });

        Gate::define('test-overview', function (User $user) {
            return in_array($user->role_id, [Role::IS_ADMIN, Role::IS_TEACHER]);
        });
    }
}
