<?php

namespace App\Services\Management\Providers;

use App\Services\Management\Console\CreateAdmin;
use App\Services\Management\Console\CreateRole;
use App\Services\Management\Console\SetPermissionToAdmin;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;

/**
 *
 */
class ManagementServiceProvider extends ServiceProvider
{
    /**
     * LIST OF COMMAND
     */
    const COMMANDS = [
        CreateAdmin::class,
        CreateRole::class,
        SetPermissionToAdmin::class,
    ];

    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/Management/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot():void
    {
        $this->loadMigrationsFrom([
            realpath(__DIR__ . '/../database/migrations')
        ]);
    }

    /**
    * Register the Management service provider.
    *
    * @return void
    */
    public function register():void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);

        $this->registerResources();
        $this->registerCommands();
    }

    /**
     * Register the Management service resource namespaces.
     *
     * @return void
     */
    protected function registerResources():void
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('management', base_path('resources/views/vendor/management'));
        View::addNamespace('management', realpath(__DIR__.'/../resources/views'));
    }

    /**
     * @return void
     */
    protected function registerCommands(): void
    {
        $this->commands(self::COMMANDS);
    }
}
