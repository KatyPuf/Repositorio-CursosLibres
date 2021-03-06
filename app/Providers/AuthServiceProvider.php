<?php

namespace App\Providers;

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

        
        Gate::define('create', function($user){
            foreach($user->roles as $roles){
                if($roles->role == "admin"){
                    return true;
                }
                
                return false;
            }
        });
        Gate::define('show', function($user){
            /*foreach($user->roles as $roles){
                if($roles->role == "Administrador"){
                    return true;
                }
                return false;
            }*/
            if(auth()->user()->hasRole('Administrador'))
            {
                return true;

            }
            return false;
        });
        Gate::define('acceso', function($user){
            foreach($user->roles as $roles){
                if($roles->role == "admin"){
                    return true;
                }
                return false;
            }
        });
    }
}
