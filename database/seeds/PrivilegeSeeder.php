<?php

use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_employee_privileges')->insert([
            [
                'role_id' => '2',
                'permission_id' => '13',
            ],
            [
                'role_id' => '2',
                'permission_id' => '14',
            ],
            [
                'role_id' => '2',
                'permission_id' => '15',
            ],
            [
                'role_id' => '3',
                'permission_id' => '13',
            ],
            [
                'role_id' => '3',
                'permission_id' => '14',
            ],
            [
                'role_id' => '3',
                'permission_id' => '15',
            ],
            [
                'role_id' => '3',
                'permission_id' => '16',
            ],
            [
                'role_id' => '3',
                'permission_id' => '17',
            ],
            [
                'role_id' => '17',
                'permission_id' => '21',
            ],
            
        ]);
    }
}