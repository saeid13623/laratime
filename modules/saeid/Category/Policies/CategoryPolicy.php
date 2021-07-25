<?php

namespace saeid\Category\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\RolePermission\Models\Permission;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new Policies instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORY) ||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN);
    }
    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORY) ||
            $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN);
    }
}
