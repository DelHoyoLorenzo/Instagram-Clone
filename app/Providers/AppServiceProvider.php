<?php

namespace App\Providers;

use App\Models\Profile;
use App\Policies\ProfilePolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Profile::class => ProfilePolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::policy(Profile::class, ProfilePolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}