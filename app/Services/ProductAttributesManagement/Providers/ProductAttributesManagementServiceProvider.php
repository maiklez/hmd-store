<?php

namespace App\Services\ProductAttributesManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\ProductAttributesManagement\Providers\RouteServiceProvider;
use App\Services\ProductAttributesManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ProductAttributesManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/ProductAttributesManagement/database/migrations
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
    * Register the ProductAttributesManagement service provider.
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
     * Register the ProductAttributesManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('product_attributes_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('product_attributes_management', base_path('resources/views/vendor/product_attributes_management'));
        View::addNamespace('product_attributes_management', realpath(__DIR__.'/../resources/views'));
    }
}
