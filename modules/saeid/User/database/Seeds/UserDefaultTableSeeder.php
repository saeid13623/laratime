<?php
namespace saeid\User\database\Seeds;

use App\User;
use Illuminate\Database\Seeder;
use saeid\RolePermission\Models\Permission;
use saeid\RolePermission\Models\Role;

class UserDefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (User::$defaultUser as $user){
        User::firstOrCreate(
            ["email" => $user['email']],
            [
                "email"=>$user['email'],
                "name"=>$user['name'],
                "password"=>bcrypt($user['password']),

            ]
        )->assignRole($user['role']);
    }

    }
}
