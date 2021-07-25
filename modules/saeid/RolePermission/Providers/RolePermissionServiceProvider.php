<?php
namespace saeid\RolePermission\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use saeid\RolePermission\database\Seeds\RolePermissionSeederTabel;
use saeid\RolePermission\Models\Permission;
use saeid\RolePermission\Models\Role;
use saeid\RolePermission\policies\RolePermissionPolicy;

class RolePermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ .'/../Routes/RolePermission_route.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Permission');
        $this->loadJsonTranslationsFrom(__DIR__ .'/../Resources/lang');
        \DatabaseSeeder::$seeders[] = RolePermissionSeederTabel::class;
        Gate::policy(Role::class,RolePermissionPolicy::class);
        Gate::before(function ($user){
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }
    public function boot()
    {
        $this->app->booted(function (){
            config()->set('sidebar.items.Rolepermission',[
                "icon"=>"i-role-permissions",
                'url'=>route('role-permissions.index'),
                'title'=>'نقشهای کاربری',
                'permission'=>Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS,
            ]);
        });
    }
}
