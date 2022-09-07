<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $request = Request::capture();

        $lang = $request->has('lang') ? $request->lang : 'fa';

        app()->setLocale($lang);

        View::composer('*', function ($view) use ($lang) {
            $setting = Setting::first();
            $view->with('setting', $setting);
            $view->with('lang', $lang);
        });
    }
}
