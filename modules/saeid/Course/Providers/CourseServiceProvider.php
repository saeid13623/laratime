<?php
namespace saeid\Course\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use saeid\Course\Model\Course;
use saeid\Course\Model\Lesson;
use saeid\Course\Model\Season;
use saeid\Course\Policies\CoursePolicy;
use saeid\Course\Policies\LessonPolicy;
use saeid\Course\Policies\SeasonPolicy;
use saeid\RolePermission\Models\Permission;

class CourseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__ .'/../Resources/Views','Courses');
        $this->loadRoutesFrom(__DIR__ .'/../Routes/course_route.php');
        $this->loadRoutesFrom(__DIR__ .'/../Routes/season_route.php');
        $this->loadRoutesFrom(__DIR__ .'/../Routes/lesson_route.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');
        Gate::policy(Course::class,CoursePolicy::class);
        Gate::policy(Season::class,SeasonPolicy::class);
        Gate::policy(Lesson::class,LessonPolicy::class);
    }
    public function boot()
    {
        $this->app->booted(function (){
            config()->set('sidebar.items.Courses',[
                'icon'=>'i-courses',
                'title'=>'دوره ها',
                'url'=>route('courses.index'),
                'permission'=>[
                    Permission::PERMISSION_MANAGE_COURSE,
                    Permission::PERMISSION_MANAGE_OWN_COURSE,
                ],
            ]);
        });
    }
}
