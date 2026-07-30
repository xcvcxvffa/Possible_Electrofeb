<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $setting = null;
            if ($setting === null) {
                if (\Illuminate\Support\Facades\Schema::hasTable('website_settings')) {
                    $setting = \App\Models\WebsiteSetting::first() ?? new \App\Models\WebsiteSetting();
                } else {
                    $setting = new \App\Models\WebsiteSetting();
                }
            }

            $globalProducts = collect();
            $globalCategories = collect();
            if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                $globalProducts = \App\Models\Product::with('cardMedia')->where('status', true)->orderBy('sort_order')->get();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('product_categories')) {
                $globalCategories = \App\Models\ProductCategory::where('status', true)->orderBy('sort_order')->get();
            }

            $view->with('setting', $setting)
                 ->with('globalProducts', $globalProducts)
                 ->with('globalCategories', $globalCategories);
        });
    }
}
