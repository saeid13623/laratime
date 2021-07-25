<?php
namespace saeid\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/fileServices.php','fileServices');
        $this->loadRoutesFrom(__DIR__ . '/../routes/media_route.php');
    }
    public function boot()
    {

    }
}
