<?php

namespace App\Providers;

use App\Interfaces\UserInterface;
use App\Interfaces\WorkOrderInterface;
use App\Reporsitories\UserRepository;
use App\Repositories\WorkOrderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind( UserInterface::class, UserRepository::class);
        $this->app->bind( WorkOrderInterface::class, WorkOrderRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
