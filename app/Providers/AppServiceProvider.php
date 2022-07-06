<?php


namespace App\Providers;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Social;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Video;

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
        view()->composer('*',function($view){
            $product=Product::all()->count();
            // $product_views=Product::orderBy('product_views','Desc')->take(20)->get();
            $order=Order::all()->count();
            $videoo=Video::all()->count();
            $customer=Customer::all()->count();
            $all_video = Video::orderBy('video_id', 'desc')->limit(6)->get();
            
            $view->with(compact('product','order','customer','videoo','all_video'));
            });

    }
}
