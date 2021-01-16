<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use function Symfony\Component\Translation\t;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repository\User\UserRepositoryInterface::class,
            //\App\Repository\User\UserEQRepository::class,
            \App\Repository\User\UserQBRepository::class,
            //post repository container
            \App\Repository\Post\PostRepositoyInterface::class,
            \App\Repository\Post\PostEQrepositoy::class,
            //\App\Repository\Post\PostQBRepositoty::class,
        );
    }

    public function boot()
    {
    }
}
