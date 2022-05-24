<?php

namespace App\Providers;

use App\Actions\LinkHashAction;
use App\Actions\LinkHashExistAction;
use App\Actions\LinkUpdateAction;
use Illuminate\Support\ServiceProvider;

class LinkActionsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LinkHashAction::class, function ($app) {
            return new LinkHashAction();
        });

        $this->app->singleton(LinkUpdateAction::class, function ($app) {
            return new LinkUpdateAction();
        });

        $this->app->singleton(LinkHashExistAction::class, function ($app) {
            return new LinkHashExistAction();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
