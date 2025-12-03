<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use Illuminate\Support\ServiceProvider;

class WebsiteSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $websiteSetting = WebsiteSetting::first();
        view()->share('websiteSetting', $websiteSetting);
    }
}
