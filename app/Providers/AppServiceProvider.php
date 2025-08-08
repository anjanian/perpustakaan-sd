<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Resources\Pages\CreateRecord;

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
        CreateRecord::disableCreateAnother();
    }
}
