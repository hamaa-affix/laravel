<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repository\User\UserRepositoryInterface::class,
            //\App\Repository\User\UserEQRepository::class,
            \App\Repository\User\UserQBRepository::class
        );
    }

    public function boot()
    {
    }
}
