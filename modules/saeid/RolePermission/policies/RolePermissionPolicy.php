<?php


namespace saeid\RolePermission\policies;


use saeid\RolePermission\Models\Permission;

class RolePermissionPolicy
{
    public function manageRolePermission()
    {
        if(auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)) return true;

    }
}
