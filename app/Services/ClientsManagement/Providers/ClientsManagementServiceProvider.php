<?php

namespace App\Services\ClientsManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\ClientsManagement\Providers\RouteServiceProvider;
use App\Services\ClientsManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ClientsManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/ClientsManagement/database/migrations
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
    * Register the ClientsManagement service provider.
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
     * Register the ClientsManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('clients_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('clients_management', base_path('resources/views/vendor/clients_management'));
        View::addNamespace('clients_management', realpath(__DIR__.'/../resources/views'));
    }
}
