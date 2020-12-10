<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Brand;

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
        $listCategory = Category::where('status', 1)->get();
        View::share('listCategory', $listCategory);
        $listBrand = Brand::where('status', 1)->get();
        View::share('listBrand', $listBrand);
    }
}
