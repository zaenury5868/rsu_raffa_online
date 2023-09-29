<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->functionHelper();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }

    protected function functionHelper()
    {
        foreach (glob(__DIR__.'/../Services/*.php') as $namefile) {
            require_once $namefile;
        }
    }
}
