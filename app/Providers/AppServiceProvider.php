<?php

namespace App\Providers;

use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Location;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Service;
use App\Models\Article;
use App\Models\Doctor;


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
        $partner = Partner::all();
        $setting = Setting::first();
        $latestArticles = Article::latest()->take(4)->get();
        View::share('setting', $setting);
        View::share('partner', $partner);
        View::share('latestArticles', $latestArticles);


        View::share('locations', Location::all());
        View::share('branches', Branch::all());
        View::share('departments', Department::all());
        View::share('services', Service::all());
        View::share('doctors', Doctor::all());
        View::share('setting', Setting::first());
        View::share('beforeAfters', \App\Models\BeforeAfter::latest()->take(8)->get());
        View::share('offers', \App\Models\Offer::where('end_date', '>=', now())->latest()->get());

    }
}
