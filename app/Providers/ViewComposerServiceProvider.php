<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\PermissionRole;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('components.navbar.navbar', function ($view) {
            if(auth()->check()){
                $auth_roles = auth()->user()->roles()->pluck('id');
                // dd($auth_roles);
                $modules_and_permissions = PermissionRole::select('module_id', 'permissions')->whereIn('role_id', $auth_roles)->get()->toArray();
                $modules = Module::orderByDesc('id')->get()->toArray();
                // dd($modules,$modules_and_permissions);
                $view->with(compact('modules', 'modules_and_permissions'));
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
