<?php

namespace App\Providers;

use App\Models\SocialMediaAccount;
use Illuminate\Support\Facades\View;
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
        $socialMedia = SocialMediaAccount::latest()->get();

        View::share('socialMedia', $socialMedia);
    }
}
