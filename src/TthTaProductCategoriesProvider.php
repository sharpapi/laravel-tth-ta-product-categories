<?php

declare(strict_types=1);

namespace SharpAPI\TthTaProductCategories;

use Illuminate\Support\ServiceProvider;

/**
 * @api
 */
class TthTaProductCategoriesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sharpapi-tth-ta-product-categories.php' => config_path('sharpapi-tth-ta-product-categories.php'),
            ], 'sharpapi-tth-ta-product-categories');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the app configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharpapi-tth-ta-product-categories.php', 'sharpapi-tth-ta-product-categories'
        );
    }
}