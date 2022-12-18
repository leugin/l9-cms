<?php

namespace App\Foundation\Modules;

use App\Data\Repository\CacheModuleRepository;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ModuleRepository::class, CacheModuleRepository::class);
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
