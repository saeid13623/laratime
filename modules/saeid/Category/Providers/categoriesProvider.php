<?php

namespace saeid\Category\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use saeid\Category\Model\Category;
use saeid\Category\Policies\CategoryPolicy;
use saeid\RolePermission\Models\Permission;

Class categoriesProvider extends ServiceProvider{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/category_route.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Category');
        Gate::policy(Category::class,CategoryPolicy::class);
    }
    public function boot()
    {
        config()->set('sidebar.items.Category',[
            "icon"=>" i-categories",
            "title"=>"دسته بندیها",
            "url"=>route('category.index'),
            'permission'=>Permission::PERMISSION_MANAGE_CATEGORY,
        ]);
    }
}
