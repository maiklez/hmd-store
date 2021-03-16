<?php

namespace App\Services\ContactsManagement\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\ContactsManagement\Providers\RouteServiceProvider;
use App\Services\ContactsManagement\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ContactsManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/ContactsManagement/database/migrations
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
    * Register the ContactsManagement service provider.
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
     * Register the ContactsManagement service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('contacts_management', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('contacts_management', base_path('resources/views/vendor/contacts_management'));
        View::addNamespace('contacts_management', realpath(__DIR__.'/../resources/views'));
    }
}
