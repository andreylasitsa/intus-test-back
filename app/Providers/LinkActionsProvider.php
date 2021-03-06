<?php

namespace App\Providers;

use App\Actions\LinkCheckerAction;
use App\Actions\LinkGenerateAction;
use App\Actions\LinkHashAction;
use App\Actions\LinkHashExistAction;
use App\Actions\LinkUpdateAction;
use GuzzleHttp\Client;
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
        $this->app->singleton(LinkHashAction::class, function () {
            return new LinkHashAction();
        });

        $this->app->singleton(LinkUpdateAction::class, function () {
            return new LinkUpdateAction();
        });

        $this->app->singleton(LinkHashExistAction::class, function () {
            return new LinkHashExistAction();
        });

        $this->app->singleton(LinkCheckerAction::class, function () {
            return new LinkCheckerAction(new Client());
        });

        $this->app->singleton(LinkGenerateAction::class, function ($app) {
            return new LinkGenerateAction(
                $app->get(LinkHashAction::class),
                $app->get(LinkUpdateAction::class),
                $app->get(LinkHashExistAction::class),
                $app->get(LinkCheckerAction::class)
            );
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
