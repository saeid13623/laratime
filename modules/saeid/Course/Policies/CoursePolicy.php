<?php

namespace saeid\Course\Policies;


use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\RolePermission\Models\Permission;

class CoursePolicy
{
    use HandlesAuthorization;

    public function manage($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)) return true;
    }
    public function index($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE))
             return true;
    }
    public function store($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE))

            return true;


    }
    public function delete($user,$course)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)
            && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
            && $course->teacher_id == $user->id )
            return true;
    }
    public function edit($user,$course)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)
            || $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
            && $course->teacher_id == $user->id  )
            return true;
    }

    public function details($user,$course)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)
                || $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
                && $course->teacher_id == $user->id)
                return true;

    }
    public function changeConfirmationStatus($user,$course)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE) && $course->teacher_id == $user->id)
            return true;
    }
    public function createSeason($user,$course)
    {
        /*if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)
            && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
            && $course->teacher_id == $user->id  )
            return true;*/

        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)){
            return true;
        }
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE) && $course->teacher_id == $user->id){
            return true;
        }
    }

    public function download($user,$course)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE) ||
            $user->id == $course->teacher_id ||
            $course->hasStudent($user->id)
        )return true;

        return false;
    }



}
