<?php

namespace Ravenna\AirefsAnalytics;

use Statamic\Providers\AddonServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Ravenna\AirefsAnalytics\Middleware\TrackEntryView;
use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
        // Merge config FIRST to ensure Laravel has a valid array
        $this->mergeConfigFrom(__DIR__.'/../config/airefs-analytics.php', 'airefs-analytics');

        // Load routes and views
        $this->loadRoutesFrom(__DIR__ . '/../routes/cp.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'airefs-analytics');

        // Nav setup
        $this->bootNav();

        // Register global middleware
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(TrackEntryView::class);
    }

    protected function bootNav()
    {
        Nav::extend(function ($nav) {
            $nav->tool('Airefs Analytics')->section('Tools')
                ->route('airefs-analytics.index')
                ->icon('charts');
        });
    }
}
