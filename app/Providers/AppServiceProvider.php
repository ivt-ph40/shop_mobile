<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        // $categories = Category::all();
        // View::share('category', $categories);
        // $parentcategories = Category::where('parent_id', 0)->get();
        // View::share('parentcategory', $parentcategories);
    }
}
