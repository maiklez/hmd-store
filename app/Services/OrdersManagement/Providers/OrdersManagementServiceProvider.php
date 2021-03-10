<?php

namespace App\Services\OrdersManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\OrdersManagement\Providers\RouteServiceProvider;
use App\Services\OrdersManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class OrdersManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/OrdersManagement/database/migrations
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
    * Register the OrdersManagement service provider.
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
     * Register the OrdersManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('orders_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('orders_management', base_path('resources/views/vendor/orders_management'));
        View::addNamespace('orders_management', realpath(__DIR__.'/../resources/views'));
    }
}
