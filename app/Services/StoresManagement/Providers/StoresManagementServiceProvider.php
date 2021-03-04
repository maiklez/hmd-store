<?php

namespace App\Services\StoresManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\StoresManagement\Providers\RouteServiceProvider;
use App\Services\StoresManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class StoresManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/StoresManagement/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            realpath(__DIR__ . '/../database/migrations')
        ]);
    }

    /**
    * Register the StoresManagement service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);

        $this->registerResources();
    }

    /**
     * Register the StoresManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('stores_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('stores_management', base_path('resources/views/vendor/stores_management'));
        View::addNamespace('stores_management', realpath(__DIR__.'/../resources/views'));
    }
}
