<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        $this->registerGeneralPolicies();
        //
    }

    public function registerGeneralPolicies()
    {
        if (Schema::hasTable('permissions')) {
            $permissions = Permission::all();
            foreach ($permissions as $perm) {
                $name = $perm->name;
                Gate::define($perm->name, function ($user) use ($name) {
                    return $user->hasAccess($name);
                });
            }
        }

    }
}
