<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\Permissions;
use App\Models\User;


class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // try {
        //     Permissions::get()->map(function($perm) {
        //         Gate::define($perm->slug, function($user) use ($perm) {
        //             return $perm;
                    
        //             // return $user->hasPermission($perm->slug, $user->usertype);
        //         });
        //     });
        // } catch (\Exception $e) {
        //     return false;
        // }
    }
}
