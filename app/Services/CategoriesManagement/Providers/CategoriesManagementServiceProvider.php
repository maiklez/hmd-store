<?php

namespace App\Services\CategoriesManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\CategoriesManagement\Providers\RouteServiceProvider;
use App\Services\CategoriesManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class CategoriesManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/CategoriesManagement/database/migrations
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
    * Register the CategoriesManagement service provider.
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
     * Register the CategoriesManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('categories_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('categories_management', base_path('resources/views/vendor/categories_management'));
        View::addNamespace('categories_management', realpath(__DIR__.'/../resources/views'));
    }
}
