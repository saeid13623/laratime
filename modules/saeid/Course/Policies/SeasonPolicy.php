<?php

namespace saeid\Course\Policies;


use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\RolePermission\Models\Permission;

class SeasonPolicy
{
    use HandlesAuthorization;


    public function delete($user,$season)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)) return true;

        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
            && $season->course->teacher_id == $user->id ) return true;
    }
    public function edit($user,$season)
    {

        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE)) return true;

        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE)
            && $season->course->teacher_id == $user->id ) return true;
    }


    public function changeConfirmationStatus($user,$season)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSE) && $season->course->teacher_id == $user->id)
            return true;
    }


}
