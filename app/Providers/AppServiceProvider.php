<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('flag', 'Persimmon\Validator\MyValidator@validateFlag');


        $cate_model = DB::connection('mysql3')->table('category');

        $this->vr_category =$cate_model->orderBy('sort','asc')->get()->keyBy('id')->toArray();
        view()->share('vr_category', $this->vr_category);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
