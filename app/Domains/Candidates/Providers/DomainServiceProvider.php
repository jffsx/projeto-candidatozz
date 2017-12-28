<?php

namespace Candidatozz\Domains\Candidates\Providers;

use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(BindServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }
}
