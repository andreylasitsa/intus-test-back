<?php

namespace App\Providers;

use App\Actions\LinkHashAction;
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
