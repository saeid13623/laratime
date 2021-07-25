<?php
namespace saeid\User\Providers;


use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use saeid\RolePermission\Models\Permission;
use saeid\User\Http\Middleware\getUserIp;
use saeid\User\database\Seeds\UserDefaultTableSeeder;
use saeid\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user-route.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/View','User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
        \DatabaseSeeder::$seeders[] = UserDefaultTableSeeder::class;
        Gate::policy(User::class,UserPolicy::class);
        $this->app['router']->pushMiddlewareToGroup('web',getUserIp::class);

    }
    public function boot(){
        $this->app->booted(function (){
            config()->set('sidebar.items.Users',[
                'icon'=>'i-users',
                'title'=>'کاربران',
                'url'=>route('users.index'),
                'permission'=>Permission::PERMISSION_MANAGE_USERS,
            ]);
            config()->set('sidebar.items.UsersProfile',[
                'icon'=>'i-user__inforamtion',
                'title'=>'اطلاعات کاربری',
                'url'=>route('users.profile'),

            ]);
        });
    }
}
