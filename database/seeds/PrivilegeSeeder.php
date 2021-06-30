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
            // [
            //     'role_id' => '2',
            //     'permission_id' => '13',
            // ],
            // [
            //     'role_id' => '2',
            //     'permission_id' => '14',
            // ],
            // [
            //     'role_id' => '2',
            //     'permission_id' => '15',
            // ],
            // [
            //     'role_id' => '3',
            //     'permission_id' => '13',
            // ],
            // [
            //     'role_id' => '3',
            //     'permission_id' => '14',
            // ],
            // [
            //     'role_id' => '3',
            //     'permission_id' => '15',
            // ],
            // [
            //     'role_id' => '3',
            //     'permission_id' => '16',
            // ],
            // [
            //     'role_id' => '3',
            //     'permission_id' => '17',
            // ],
            // [
            //     'role_id' => '4',
            //     'permission_id' => '13',
            // ],
            // [
            //     'role_id' => '4',
            //     'permission_id' => '14',
            // ],
            // [
            //     'role_id' => '4',
            //     'permission_id' => '15',
            // ],
            // [
            //     'role_id' => '4',
            //     'permission_id' => '16',
            // ],
            // [
            //     'role_id' => '4',
            //     'permission_id' => '17',
            // ],
            // [
            //     'role_id' => '17',
            //     'permission_id' => '21',
            // ],

            // [
            //     'role_id' => '5',
            //     'permission_id' => '13',
            // ],
            // [
            //     'role_id' => '5',
            //     'permission_id' => '14',
            // ],
            // [
            //     'role_id' => '5',
            //     'permission_id' => '15',
            // ],
            // [
            //     'role_id' => '5',
            //     'permission_id' => '16',
            // ],
            // [
            //     'role_id' => '5',
            //     'permission_id' => '17',
            // ],

            //5s
            //Harus perbaiki dulu kalau migrate:refresh
            [
                'role_id' => '8',
                'permission_id' => '22',
            ],
            [
                'role_id' => '8',
                'permission_id' => '23',
            ],
            [
                'role_id' => '8',
                'permission_id' => '24',
            ],
            [
                'role_id' => '8',
                'permission_id' => '26',
            ],

            //attendance
            [
                'role_id' => '23',
                'permission_id' => '27',
            ],
            [
                'role_id' => '23',
                'permission_id' => '28',
            ],
            [
                'role_id' => '23',
                'permission_id' => '29',
            ],
            [
                'role_id' => '23',
                'permission_id' => '31',
            ],
        ]);
    }
}
