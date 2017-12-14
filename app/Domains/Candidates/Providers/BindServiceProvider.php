<?php

namespace Candidatozz\Domains\Candidates\Providers;

use Illuminate\Support\ServiceProvider;
use Candidatozz\Domains\Candidates\Contracts\CandidateRepositoryContract;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;
use Candidatozz\Domains\Candidates\Repositories\CandidateRepository;
use Candidatozz\Domains\Candidates\Services\CandidateService;

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
            CandidateRepositoryContract::class,
            CandidateRepository::class
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
            CandidateServiceContract::class,
            CandidateService::class
        );
    }
}
