<?php

namespace App\Services\ProvidersManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\ProvidersManagement\Providers\RouteServiceProvider;
use App\Services\ProvidersManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ProvidersManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/ProvidersManagement/database/migrations
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
    * Register the ProvidersManagement service provider.
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
     * Register the ProvidersManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('providers_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('providers_management', base_path('resources/views/vendor/providers_management'));
        View::addNamespace('providers_management', realpath(__DIR__.'/../resources/views'));
    }
}
