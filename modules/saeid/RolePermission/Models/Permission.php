<?php


namespace saeid\RolePermission\Models;




class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_ROLE_PERMISSIONS='manage role-permissions';
    const PERMISSION_MANAGE_CATEGORY='manage-category';
    const PERMISSION_MANAGE_COURSE='manage-course';
    const PERMISSION_MANAGE_OWN_COURSE='manage-own-course';
    const PERMISSION_MANAGE_USERS='manage-users';
    const PERMISSION_MANAGE_PAYMENTS='manage-payments';
    const PERMISSION_SUPER_ADMIN='super_admin';
    const PERMISSION_TEACH='teach';

    static $permissions=[
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_CATEGORY,
        self::PERMISSION_MANAGE_COURSE,
        self::PERMISSION_MANAGE_OWN_COURSE,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_PAYMENTS,
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_TEACH
    ];



}
