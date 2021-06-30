<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_employee_permissions')->insert([
            // [
            //     'name' => 'view user',
            //     'e_permission_desc' => 'view user',
            //     'e_permission_category' => 'user',
            // ],[
            //     'name' => 'edit user',
            //     'e_permission_desc' => 'edit user',
            //     'e_permission_category' => 'user',
            // ],[
            //     'name' => 'create user',
            //     'e_permission_desc' => 'create user',
            //     'e_permission_category' => 'user',
            // ],[
            //     'name' => 'delete user',
            //     'e_permission_desc' => 'delete user',
            //     'e_permission_category' => 'user',
            // ],[
            //     'name' => 'view role',
            //     'e_permission_desc' => 'view role',
            //     'e_permission_category' => 'role',
            // ],[
            //     'name' => 'edit role',
            //     'e_permission_desc' => 'edit role',
            //     'e_permission_category' => 'role',
            // ],[
            //     'name' => 'create role',
            //     'e_permission_desc' => 'create role',
            //     'e_permission_category' => 'role',
            // ],[
            //     'name' => 'delete role',
            //     'e_permission_desc' => 'delete role',
            //     'e_permission_category' => 'role',
            // ],[
            //     'name' => 'view master',
            //     'e_permission_desc' => 'view master',
            //     'e_permission_category' => 'master',
            // ],[
            //     'name' => 'edit master',
            //     'e_permission_desc' => 'edit master',
            //     'e_permission_category' => 'master',
            // ],[
            //     'name' => 'create master',
            //     'e_permission_desc' => 'create master',
            //     'e_permission_category' => 'master',
            // ],[
            //     'name' => 'delete master',
            //     'e_permission_desc' => 'delete master',
            //     'e_permission_category' => 'master',
            // ],[
            //     'name' => 'view work order',
            //     'e_permission_desc' => 'view work order',
            //     'e_permission_category' => 'work order',
            // ],[
            //     'name' => 'create work order',
            //     'e_permission_desc' => 'create work order',
            //     'e_permission_category' => 'work order',
            // ],
            // [
            //     'name' => 'edit work order',
            //     'e_permission_desc' => 'edit work order',
            //     'e_permission_category' => 'work order',
            // ],
            // [
            //     'name' => 'delete work order',
            //     'e_permission_desc' => 'delete work order',
            //     'e_permission_category' => 'work order',
            // ],[
            //     'name' => 'spv issuer work order',
            //     'e_permission_desc' => 'spv issuer work order',
            //     'e_permission_category' => 'work order',
            // ],[
            //     'name' => 'spv pic work order',
            //     'e_permission_desc' => 'spv pic work order',
            //     'e_permission_category' => 'work order',
            // ],[
            //     'name' => 'planner work order',
            //     'e_permission_desc' => 'planner work order',
            //     'e_permission_category' => 'work order',
            // ],[
            //     'name' => 'spv pic work order',
            //     'e_permission_desc' => 'spv pic work order',
            //     'e_permission_category' => 'work order',
            // ],
            // [
            //     'name' => 'create inspection form',
            //     'e_permission_desc' => 'create inspection form',
            //     'e_permission_category' => 'work order',
            // ],
            [
                'name' => 'view 5s form',
                'e_permission_desc' => 'view 5s form',
                'e_permission_category' => '5s form',
            ],
            [
                'name' => 'create 5s form',
                'e_permission_desc' => 'create 5s form',
                'e_permission_category' => '5s form',
            ],
            [
                'name' => 'update 5s form',
                'e_permission_desc' => 'update 5s form',
                'e_permission_category' => '5s form',
            ],
            [
                'name' => 'approve 5s form',
                'e_permission_desc' => 'approve 5s form',
                'e_permission_category' => '5s form',
            ],
            //attendance
            [
                'name' => 'view attendance form',
                'e_permission_desc' => 'view attendance form',
                'e_permission_category' => 'attendance form',
            ],
            [
                'name' => 'create attendance form',
                'e_permission_desc' => 'create attendance form',
                'e_permission_category' => 'attendance form',
            ],
            [
                'name' => 'update attendance form',
                'e_permission_desc' => 'update attendance form',
                'e_permission_category' => 'attendance form',
            ],
            [
                'name' => 'approve attendance form',
                'e_permission_desc' => 'approve attendance form',
                'e_permission_category' => 'attendance form',
            ],
        ]);
    }
}
