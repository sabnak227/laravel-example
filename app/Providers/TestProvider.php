<?php

namespace App\Providers;

use App\Service\TestClient;
use App\Service\TestInterface;
use Illuminate\Support\ServiceProvider;

class TestProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // note: this is fired at the dep registration process

        $this->app->bind(TestInterface::class, TestClient::class);
//        $this->app->singleton(TestInterface::class, TestClient::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // note: this is fired after all service container has being registered
    }
}
