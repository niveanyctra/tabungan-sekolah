<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', function (User $user) {
            $admin = $user->role_id === 2;
            $superadmin = $user->role_id === 1;
            return $admin || $superadmin;
        });
        Gate::define('manage-vocationals', function (User $user) {
            $admin = $user->role_id === 2;
            $superadmin = $user->role_id === 1;
            return $admin || $superadmin;
        });
        Gate::define('manage-classrooms', function (User $user) {
            $admin = $user->role_id === 2;
            $superadmin = $user->role_id === 1;
            return $admin || $superadmin;
        });
        Gate::define('manage-students', function (User $user) {
            $admin = $user->role_id === 2;
            $superadmin = $user->role_id === 1;
            return $admin || $superadmin;
        });
        Gate::define('students-active', function (User $user) {
            $user->role_id = 4;
            $user->status = true;
            return $user;
        });
    }
}
