<?php

namespace Encore\Admin\CustomLogViewer;

use Encore\Admin\Admin;

trait BootExtension
{
    /**
     * {@inheritdoc}
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('custom-log-viewer', __CLASS__);
    }

    /**
     * Register routes for laravel-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->get('custom-logs', 'Encore\Admin\CustomLogViewer\CustomLogController@index')->name('custom-log-viewer-index');
            $router->get('custom-logs/{file}', 'Encore\Admin\CustomLogViewer\CustomLogController@index')->name('custom-log-viewer-file');
            $router->get('custom-logs/{file}/tail', 'Encore\Admin\CustomLogViewer\CustomLogController@tail')->name('custom-log-viewer-tail');
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::createMenu('Custom Log viewer', 'custom-logs', 'fa-database');

        parent::createPermission('Custom Logs', 'ext.log-viewer', 'logs*');
    }
}
