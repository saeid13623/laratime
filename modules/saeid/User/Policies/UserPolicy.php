<?php

namespace saeid\User\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\RolePermission\Models\Permission;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS))
        {
            return true;
        }
    }
    public function manage($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS))
        {
            return true;
        }
    }
    public function addRole($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS))
        {
            return true;
        }
    }
    public function edit($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS))
        {
            return true;
        }
    }
    public function editProfile(){
        if (auth()->check()) return true;
    }
}
