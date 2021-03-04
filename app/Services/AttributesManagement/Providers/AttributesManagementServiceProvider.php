<?php

namespace App\Services\AttributesManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\AttributesManagement\Providers\RouteServiceProvider;
use App\Services\AttributesManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class AttributesManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/AttributesManagement/database/migrations
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
    * Register the AttributesManagement service provider.
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
     * Register the AttributesManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('attributes_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('attributes_management', base_path('resources/views/vendor/attributes_management'));
        View::addNamespace('attributes_management', realpath(__DIR__.'/../resources/views'));
    }
}
