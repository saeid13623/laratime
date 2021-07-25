<?php

namespace saeid\Dashboard\Providers;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/Views','Dashboard');
        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard_route.php');
        $this->mergeConfigFrom(__DIR__ . '/../Config/sidebar.php','sidebar');
    }
    public function boot()
    {
        $this->app->booted(function (){
            config()->set('sidebar.items.Dashboard',[
                "icon"=>"i-dashboard",
                'url'=>route('dashboard'),
                'title'=>'پیشخوان'
            ]);
        });
    }
}
