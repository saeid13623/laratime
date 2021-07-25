<?php

namespace saeid\Course\Policies;


use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\Course\Model\Course;
use saeid\RolePermission\Models\Permission;


class LessonPolicy
{
    use HandlesAuthorization;


    public function manageLesson($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE))return true;
    }

    public function edit($user,$lesson)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE) ||
            ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE) && $user->id == $lesson->course->teacher_id)
        ) return true;
    }
    public function destroy($user,$lesson)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE && $user->id == $lesson->course->teacher_id)
        ) return true;
    }


    public function download($user,$lesson)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE) ||
            $user->id == $lesson->course->teacher_id ||
            $lesson->course->hasStudent($user->id ) ||
            $lesson->is_free
        )return true;

        return false;
    }

}
