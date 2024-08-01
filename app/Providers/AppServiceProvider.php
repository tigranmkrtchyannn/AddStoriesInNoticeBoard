<?php

namespace App\Providers;

use App\Repositories\Auth\User\UserRepository;
use App\Repositories\Auth\User\UserRepositoryInterface;
use App\Repositories\Story\StoryRepository;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StoryRepositoryInterface::class, StoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
    }
}
