<?php
namespace saeid\RolePermission\database\Seeds;

use Illuminate\Database\Seeder;
use saeid\RolePermission\Models\Permission;
use saeid\RolePermission\Models\Role;

class RolePermissionSeederTabel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\saeid\RolePermission\Models\Permission::$permissions as $permission){
            Permission::findOrCreate($permission);
        }

        /*Permission::findOrCreate(Permission::PERMISSION_MANAGE_CATEGORY);
        Permission::findOrCreate(Permission::PERMISSION_SUPER_ADMIN);
        Permission::findOrCreate(Permission::PERMISSION_TEACHER);*/



        foreach (Role::$roles as $name=>$permission){
            Role::findOrCreate($name)->givePermissionTo($permission);
        }
     /*   Role::findOrCreate(Role::ROLE_SUPER_ADMIN)->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);
        Role::findOrCreate(Role::ROLE_TEACHER)->givePermissionTo(Permission::PERMISSION_TEACH);*/


    }
}
