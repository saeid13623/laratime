<?php
namespace saeid\Commen\Providers;

use Illuminate\Support\ServiceProvider;

class CommenProviders extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/View','Common');
    }
    public function boot()
    {
        require __DIR__ . "/../helpers.php";
    }
}
