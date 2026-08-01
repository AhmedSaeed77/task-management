<?php

namespace App\Providers;

use App\Repositories\Eloquent\Repository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\TaskRepository;

use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
