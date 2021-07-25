<?php


namespace saeid\RolePermission\Models;


class Role extends \Spatie\Permission\Models\Role
{

    const ROLE_SUPER_ADMIN='super_admin';
    const ROLE_TEACHER='teacher';
    const ROLE_STUDENT='student';

    /*static $roles=[
        self::ROLE_SUPER_ADMIN,
        self::ROLE_TEACHER,
        self::ROLE_STUDENT,
    ];*/
    static $roles=[
        self::ROLE_TEACHER => [Permission::PERMISSION_TEACH],
        self::ROLE_SUPER_ADMIN => [Permission::PERMISSION_SUPER_ADMIN],
        self::ROLE_STUDENT => []

        ];

}
