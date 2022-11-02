<?php

namespace Encore\Admin\CustomLogViewer;

use Illuminate\Support\ServiceProvider;

class CustomLogViewerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-admin-logs');

        CustomLogViewer::boot();
    }
}
