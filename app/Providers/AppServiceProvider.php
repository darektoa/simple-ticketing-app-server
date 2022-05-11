<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Xendit\Xendit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $xenditKey  = env('XENDIT_MODE') === 'production' ? env('XENDIT_KEY') : env('XENDIT_KEY_DEV');

        Xendit::setApiKey($xenditKey);
        Paginator::useBootstrapFive();
    }
}
