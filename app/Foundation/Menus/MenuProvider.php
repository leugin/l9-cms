<?php

namespace App\Foundation\Menus;

use App\Data\Repository\EloquentMenuRepository;
use App\Foundation\Menus\Data\Repository\MenuRepository;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MenuRepository::class, EloquentMenuRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
