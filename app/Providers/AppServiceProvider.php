<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once base_path('app/helpers.php');
        Gate::define('check_for_profile',function(User $user){
            return Auth::id() == 1;
        });
        Gate::define('master_authorization',function(User $user){
            return Auth::user()->authority_level == 'high';
        });

    }
}
