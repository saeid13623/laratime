<?php


namespace saeid\Front\Providers;
use Illuminate\Support\ServiceProvider;
use saeid\Category\Model\Category;
use saeid\Category\Repositories\CategoryRepo;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Front');
        $this->loadRoutesFrom(__DIR__ . '/../routes/front-route.php');

        view()->composer('Front::layout.header',function ($view){
            $categories=resolve(CategoryRepo::class)->tree();
            $view->with(compact('categories'));
        });
    }
    public function boot()
    {

    }

}
