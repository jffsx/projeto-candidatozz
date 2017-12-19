<?php

namespace Candidatozz\Domains\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Candidatozz\Domains\Users\Contracts\UserRepositoryContract;
use Candidatozz\Domains\Users\Contracts\UserServiceContract;
use Candidatozz\Domains\Users\Repositories\UserRepository;
use Candidatozz\Domains\Users\Services\UserService;

class BindServiceProvider extends ServiceProvider
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
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Register any repositories services.
     *
     * @return void
     */
    public function registerRepositories()
    {
        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class
        );
    }

    /**
     * Register any services.
     *
     * @return void
     */
    public function registerServices()
    {
        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );
    }
}
